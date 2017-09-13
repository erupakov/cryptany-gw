<?php

namespace App\Events;

use App\Transaction;
use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionStatusEvent extends Event implements ShouldBroadcast
{
	/**
	 * Property to hold event data
	 *
	 * @var $transaction
	 */
	public $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Transaction $t)
    {
        $this->transaction = $t;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['transactions'];
    }
}
