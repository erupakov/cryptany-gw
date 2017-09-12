<?php
/**
 * Ethereum blockchain actions controller
 * PHP Version 7
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App\Http\Controllers;

use \App\User;
use \Illuminate\Http\Request;
use \Log;
use Carbon\Carbon;
/**
 * Ethereum blockchain actions controller, used to perform actions for Ethereum 
 * blockchain
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class EthController extends Controller
{
    /**
     * Holds token for blockchain API
     *
     * @var _token
     */
    const BITCHAIN_TOKEN = "f7948af1945f4f779f4deb8988acec91";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_apiContext;

    /**
     * Construction for the class, performs API context initialization
     *
     * @method __construct
     * @return nothing
     */
    public function __construct()
    {
        $this->_apiContext = new \BlockCypher\Rest\ApiContext(
            new \BlockCypher\Auth\SimpleTokenCredential(BITCHAIN_TOKEN), 
            'main', 
            'eth' 
        );

        $this->_apiContext->setConfig(
            array(
              'mode' => 'sandbox',
              'log.LogEnabled' => true,
              'log.FileName' => 'BlockCypher.log',
              'log.LogLevel' => 'DEBUG'
            )
        );

        $webHook = new \BlockCypher\Api\WebHook(); 
        $webHook->setUrl("https://cgw.cryptany.io/eth/hook/txstat");
        $webHook->setEvent('unconfirmed-tx');

        try {
            $webHook->create($this->_apiContext);
            Log::info("Successfully set unconfirmed-tx hook: " . $webHook);
        }
        catch (\BlockCypher\Exception\BlockCypherConnectionException $ex) {
            // This will print the detailed information on the exception. 
            //REALLY HELPFUL FOR DEBUGGING
            Log::error("Error creating ETH webHook: " . $ex->getData());
        }
    }

    /**
     * Method for handling creation of new transient wallet API method
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getTransientAddress
     *
     * @return nothing
     */
    public function getTransientAddress(Request $request)
    {
        // check if all required parameters are in place
        if ($request->input('email')==null) {
            Log::error('email parameter is missing');
            abort(404, 'email parameter is mandatory for this method');
        }

        $apiuser = $this->_checkAPIUserExists($request->header('Authentication'));

        if ($apiuser===false || !isset($apiuser)) {
            Log::error('Wrong or empty appToken presented');
            abort(401, "Wrong username/appToken pair");
        }

        // Find customer by his email
        $user = App\User::firstOrCreate(['email' => $request->input('email')]);
        $user->save(); // in case the user is just created

        $wallet = new App\Wallet;
        $wallet->apiUserId = $apiuser->id;
        $wallet->userId = $user->id;

        try {
            $addressClient = new \BlockCypher\Client\AddressClient($this->_apiContext);
            $addressKeyChain = $addressClient->generateAddress();
            Log::info('New address generated:' . $addressKeyChain->getAddress());

            // fill in newly created wallet
            $wallet->publicKey = $addressKeyChain->getPublic();
            $wallet->privateKey = $addressKeyChain->getPrivate();
            $wallet->address = $addressKeyChain->getAddress();
            $wallet->wif = $addressKeyChain->getWif();
            $wallet->isActive = true;
            $wallet->expirationTime = Carbon::now()->addYear();
            $wallet->save();
        } catch (Exception $ex) {
            Log::error('Error creating new wallet:'.$ex);
        }

        return json_encode(['address'=> $addressKeyChain->getAddress()]);
    }

     /**
      * Returns status of the transaction given its hash
      *
      * @param \Illuminate\Http\Request $request Request to process
      * @param string                   $hash    Transaction hash to check
      *
      * @method getTxStatus
      *
      * @return nothing
      */
    public function getTxStatus($request, $hash)
    {
        $txClient = new \BlockCypher\Client\TXClient($this->_apiContext);
        $tx = $txClient->get($hash);
        return json_encode(['confirmed'=>$tx->confirmed]);
    }

    /**
     * Hook to catch blockchain events
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getTxStatusHookUnconfirmed
     *
     * @return nothing
     */    
    public function getTxStatusHookUnconfirmed(Request $request)
    {
        Log::info('Got hook request: unconfirmed');
        Log::debug($request);
    }

    /**
     * Hook to catch blockchain events
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getTxStatusHookConfirmed
     *
     * @return nothing
     */    
    public function getTxStatusHookConfirmed(Request $request)
    {
        Log::info('Got hook request confirmed:'. $request);
        Log::debug($request);
    }

    /**
     * Check user authentication
     *
     * @param string $authHeader authentication header from the request
     *
     * @return mixed instance of the user of FALSE if something went wrong
     */
    private function _checkUserExists($authHeader)
    {
        if (strstr($authHeader, 'Basic')!=0) {
            Log::error(
                'Wrong auth header, only Basic auth is supported: ' . $authHeader
            );
            return false;
        }

        try 
        {
            $authParts = explode(' ', $authHeader);
            $testStr = base64_decode($authParts[1]);
            $credendials = explode(':', $testStr);
            $user = App\APIUser::where(
                [
                    'username'=>$credendials[0], 
                    'appToken'=>$credendials[1]
                ]
            );
            return $user;
        } catch(Exception $ex) {
            Log::error(
                'Error during checking auth header:' . $ex->Message()
            );
            return false;
        }
    }
}
