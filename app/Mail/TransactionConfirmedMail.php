<?php
/**
 * Transaction confirmed mail template
 * PHP Version 7
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App\Mail;

use App\Transaction;
use App\Wallet;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
 * Mail template notification about successful transaction confirmation
 *
 * @category Mail
 * @package  App\Mail
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class TransactionConfirmedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	/**
	 * 
     *
     */
	public $subject = 'Cryptany transaction confirmed';
	public $from = [
			['address'=>'support@cryptany.io', 'name'=>'Cryptany support']
		];

    private $_transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $tx )
    {
        $this->_transaction = $tx;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$w = $this->_transaction->wallet;
		$t = $this->_transaction->created_at;
		$t->timezone = new \DateTimeZone('UTC');

		$srcA = 0;
		if (null!==$this->_transaction->srcAmount) {
			$srcA = number_format($this->_transaction->srcAmount, 6);
		}

		$dstA = 0;
		if (null!==$this->_transaction->dstAmount) {
			$dstA = number_format($this->_transaction->dstAmount, 2);
		}

        return $this->view('emails.tx_confirmed')
            ->with(
                [
                    'txId'=>$this->_transaction->wallet->hash,
                    'srcAmount'=>$srcA,
                    'dstAmount'=>$dstA,
                    'address'=>$this->_transaction->wallet->address,
                    'first_name'=>$this->_transaction->wallet->user->first_name,
                    'family_name'=>$this->_transaction->wallet->user->family_name,
                    'txDate'=>$t,
                ]
            );
    }
}
