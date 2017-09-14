<?php

namespace App\Events;

use App\Transaction;
use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionStatusUnconfirmedEvent extends Event implements ShouldBroadcast
{
	/**
	 * Property to hold event data
	 *
	 * @var $transaction
	 */
	public $transaction;
	private $walletHash;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Transaction $t)
    {
        $this->transaction = $t;
		$walletHash = $t->wallet->hash;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['transactions'.$this->walletHash];
    }
}
