<?php

namespace App\Listeners;

use App\Events\TransactionStatusEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  TransactionStatusEvent  $event
     * @return void
     */
    public function handle(TransactionStatusEvent $event)
    {

    }
}
