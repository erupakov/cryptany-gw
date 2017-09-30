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
use App\Mail\TransactionCreated;
use App\Mail\TransactionConfirmed;
use App\Mail\TransactionFiatSent;
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
     * Handle the event.
     *
     * @param \App\Events\TransactionCreatedEvent $event Event to handle
     *
     * @return void
     */
    public function handle(\App\Events\TransactionCreatedEvent $event)
    {
        // send mail about successful transaction creation
        $tx = $event->transaction;
        $user = $tx->wallet->user;

        Mail::to($user->email)
        ->send(new TransactionCreated($tx));
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\TransactionCreatedEvent $event Event to handle
     *
     * @return void
     */
     public function onConfirmed(\App\Events\TransactionStatusConfirmedEvent $event)
     {
         // send mail about successful transaction creation
         $tx = $event->transaction;
         $user = $tx->wallet->user;
 
         Mail::to($user->email)
         ->send(new TransactionConfirmed($tx));
     }

    /**
     * Handle the event.
     *
     * @param \App\Events\TransactionCreatedEvent $event Event to handle
     *
     * @return void
     */
     public function onFiatSent(\App\Events\TransactionStatusFiatSentEvent $event)
     {
         // send mail about successful transaction creation
         $tx = $event->transaction;
         $user = $tx->wallet->user;
 
         Mail::to($user->email)
         ->send(new TransactionFiatSent($tx));
     }

}
