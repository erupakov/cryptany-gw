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
use \Event;
use Carbon\Carbon;
use \App\Jobs\SetFiatSentJob;
use \App\Events\TransactionStatusEvent;
use \App\Events\TransactionStatusUnconfirmedEvent;
use \App\Events\TransactionStatusConfirmedEvent;

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
		$transactions = \App\Transaction::all();
        return response()->json($transactions);
    }

    /**
     * Returns details of transaction in question
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getTransaction
     *
     * @return \App\Transaction
     */
    public function getTransaction(Request $request)
    {
		$transaction = false;

		if ($request->input('id')!==null) {
			$transaction = \App\Transaction::find($request->input('id'));
		} else if ($request->input('hash')!==null) {
			$transaction = \App\Transaction::where(['hash'=>strtoupper($request->input('hash'))])->first();
		} else if ($request->input('walletHash')!==null) {
			$w = \App\Wallet::where(['hash'=>strtoupper($request->input('walletHash'))])->first();
			$transaction = $w->transactions()->first();
		} else {
			Log::error('No input parameters given');
			abort(404, 'No input parameters given');
		}

		if ($transaction===false) {
			Log::error('Specified transaction not found');
			abort(404, 'No matched transactions found');
		} else {
			return response()->json($transaction);
		}
    }

    /**
     * Changes transaction status
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method changeTxStatus
     *
     * @return \App\Transaction
     */
    public function changeTxStatus(Request $request)
	{
		$transaction = false;
		$status = 1;

		if (null!==$request->input('id')) {
			$transaction = \App\Transaction::find($request->input('id'));
		} else if (null!==$request->input('hash')) {
			$transaction = \App\Transaction::where(['hash'=>strtoupper($request->input('hash'))])->first();
		}  else if (null!==$request->input('walletHash')) {
			// Find transaction by searching walletHash
			$w = \App\Wallet::where(['hash'=>strtoupper($request->input('walletHash'))])->first();
			if (null!==$w) {
				$transaction = $w->transactions()->first();
			} else {
				Log::error('Wallet was not found with presented walletHash');
				abort(404, 'Wallet was not found with presented walletHash');
			}
		} else {
			Log::error('No input parameters given');
			abort(404, 'No input parameters given');
		}

		if (null!==$request->input('status')) {
			$status = $request->input('status');
		}

		if ($transaction===false) {
			Log::error('Specified transaction not found');
			abort(404, 'No matched transactions found');
		} else { // process status change
			$transaction->status = $status; // In future we can implement status change workflow but for now it's just ok
			$transaction->save();

			if ($status==\App\TransactionStatus::UNCONFIRMED) {
				Event::fire(new TransactionStatusUnconfirmedEvent($transaction));
			}

			if ($status==\App\TransactionStatus::CONFIRMED) {
				Event::fire(new TransactionStatusConfirmedEvent($transaction));
//				$j = new SetFiatSentJob($transaction->wallet);
//				$j->delay(Carbon::now()->addMinutes(10));
//				dispatch($j);
			}

			if ($status==\App\TransactionStatus::PAID) {
				Event::fire(new TransactionStatusFiatSentEvent($transaction));
			}

			return response()->json($transaction);
		}
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
		$wallet = \App\Wallet::where(['hash'=>$hash])->first();
		$transaction = $wallet->transactions()->first();

		Event::fire(new TransactionStatusEvent($transaction));
    }

}
