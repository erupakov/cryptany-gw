<?php

namespace App\Jobs;

use App\Wallet;
use App\Transaction;
use App\TransactionStatus;
use \Event;

class SetFiatSentJob extends Job
{
	/**
	 * @var Wallet wallet to set status on
	 */
	private $_wallet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Wallet $w)
    {
		$this->_wallet = $w;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$t = $this->_wallet->transactions()->first();
		$t->status = 6; // PAID
		$t->save();

		Event::fire(new \App\Events\TransactionStatusFiatSentEvent($t));
    }
}
