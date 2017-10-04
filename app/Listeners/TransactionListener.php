<?php
/**
 * Transaction event listener
 * PHP Version 7
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App\Listeners;

use App\User;
use App\Transaction;
use App\Wallet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\TransactionCreatedMail;
use App\Mail\TransactionConfirmedSupportMail;
use App\Mail\TransactionConfirmedMail;
use App\Mail\TransactionFiatSentMail;
use Illuminate\Support\Facades\Mail;

/**
 * Transaction event listener
 *
 * @category Listener
 * @package  App\Listeners
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class TransactionListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the Transaction created event.
     *
     * @param \App\Events\TransactionCreatedEvent $event Event to handle
     *
     * @return void
     */
    public function handle(\App\Events\TransactionCreatedEvent $event)
    {
        // send mail about successful transaction creation
        $txid = $event->txid;
		$tx = \App\Transaction::find($txid);
        $user = $tx->wallet->user;

        Mail::to($user->email)
        ->send(new TransactionCreatedMail($tx));
    }

    /**
     * Handle the TransactionStatusConfirmed event.
     *
     * @param \App\Events\TransactionStatusConfirmedEvent $event Event to handle
     *
     * @return void
     */
     public function onConfirmed(\App\Events\TransactionStatusConfirmedEvent $event)
     {
         // send mail about successful transaction creation
         $txid = $event->txid;
         $tx = \App\Transaction::find($txid);
         $user = $tx->wallet->user;

         Mail::to('support@cryptany.io')
         ->send(new TransactionConfirmedSupportMail($tx));
 
         Mail::to($user->email)
         ->send(new TransactionConfirmedMail($tx));
     }

    /**
     * Handle the TransactionFiatSent event.
     *
     * @param \App\Events\TransactionStatusFiatSentEvent $event Event to handle
     *
     * @return void
     */
     public function onFiatSent(\App\Events\TransactionStatusFiatSentEvent $event)
     {
         // send mail about successful transaction creation
         $txid = $event->txid;
         $tx = \App\Transaction::find($txid);
         $user = $tx->wallet->user;
 
         Mail::to($user->email)
         ->send(new TransactionFiatSentMail($tx));
     }

}
