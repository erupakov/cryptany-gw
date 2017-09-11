<?php

namespace App\Http\Controllers;

use \App\User;
use \Illuminate\Http\Request;
use \Log;


class EthController extends Controller
{
	private $_token = "f7948af1945f4f779f4deb8988acec91";
    /**
     * Create a new controller instance.
     *
     * @return void
	 */
	private $_apiContext;

    public function __construct()
    {
		$this->_apiContext = new \BlockCypher\Rest\ApiContext(new \BlockCypher\Auth\SimpleTokenCredential($this->_token),'main','eth');

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
			Log::info( "Successfully set unconfirmed-tx hook: " . $webHook );
		}
		catch (\BlockCypher\Exception\BlockCypherConnectionException $ex) {
			// This will print the detailed information on the exception. 
			//REALLY HELPFUL FOR DEBUGGING
			Log::error( "Error creating ETH webHook: " . $ex->getData() );
		}		
    }

    //
	public function getTransientAddress(Request $request, $id)
	{
		$request->header['Authentication'];
		$user = App\User::where( 'appToken', $id );

		if (!isset($user)) {
			Log::error('Wrong appToken presented: '.$id);
			abort(401, "Wrong appToken" );
		}

//		$wallet = new App\Wallet;
//		$wallet->userId = $user->id;
		$addressClient = new \BlockCypher\Client\AddressClient($this->_apiContext);
		$address = $addressClient->generateAddress();
	
		Log::info('New address generated:' . $address->getAddress());

		return json_encode( ['address'=> $address->getAddress()] );
	}

	// Returns status of the transaction given its hash
	public function getTxStatus($hash)
	{
		$txClient = new \BlockCypher\Client\TXClient( $this->_apiContext );
		$tx = $txClient->get($hash);
		return json_encode( ['confirmed'=>$tx->confirmed] );
	}

	// Hook to catch blockchain events
	public function getTxStatusHookUnconfirmed(Request $request)
	{
		Log::info('Got hook request: unconfirmed');
		Log::debug($request);
	
	}

	// Hook to catch blockchain events
	public function getTxStatusHookConfirmed(Request $request)
	{
		Log::info('Got hook request confirmed:'. $request);
		Log::debug($request);
	}

}
