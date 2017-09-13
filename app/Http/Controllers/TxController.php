<?php
/**
 * Generic transaction actions controller
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
 * Generic blockchain actions controller, used to perform actions for all
 * blockchains
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class TxController extends Controller
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
        $webHook->setUrl("http://cgw.cryptany.io/eth/hook/txstat");
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
     * Method returns all registered user transactions (within our system)
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getAll
     *
     * @return nothing
     */
    public function getAll(Request $request)
    {
        return '';
    }

    /**
     * Returns details of transaction in question
     *
     * @param \Illuminate\Http\Request $request Request to process
     * @param string                   $hash    Transaction hash to check
     *
     * @method getTxStatus
     *
     * @return nothing
     */
    public function getTransaction($request, $hash)
    {
        $txClient = new \BlockCypher\Client\TXClient($this->_apiContext);
        $tx = $txClient->get($hash);
        return json_encode(['confirmed'=>$tx->confirmed]);
    }

    /**
     * Method creates new transaction with specified parameters
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method createNewTransaction
     *
     * @return nothing
     */    
    public function createNewTransaction(Request $request)
    {
        Log::info('Got hook request: unconfirmed');
        Log::debug($request);
    }


    /**
     * Method fires an event for the selected wallet, used to test broadcasting
     *
     * @param \Illuminate\Http\Request $request Request to process
	 * @param string $id Wallet hash to test against
     *
     * @method getAll
     *
     * @return nothing
     */
    public function testBroadcast(Request $request, $hash)
    {
        event(new TransactionStatusEvent());
    }

}
