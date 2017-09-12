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
        $request->header['Authentication'];
        $user = App\User::where('appToken', $id);

        if (!isset($user)) {
            Log::error('Wrong appToken presented: '.$id);
            abort(401, "Wrong appToken");
        }

        //		$wallet = new App\Wallet;
        //		$wallet->userId = $user->id;
        $addressClient = new \BlockCypher\Client\AddressClient($this->_apiContext);
        $address = $addressClient->generateAddress();

        Log::info('New address generated:' . $address->getAddress());

        return json_encode(['address'=> $address->getAddress()]);
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

}
