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
class TransactionConfirmedSupportMail extends Mailable 
{
    use Queueable, SerializesModels;

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

		// get transaction events
		$te = $this->_transaction->events()->first();
		$report = json_decode( $te->report, true );

	    $amountReceived = bcdiv(number_format($report['total'],0,'',''), '10000000000000000000', 6);

		$amountToReceive = 0;
		if (null!==$this->_transaction->srcAmount) {
			$amountToReceive = number_format($this->_transaction->srcAmount, 6);
		}

        return $this->view('emails.tx_confirmed_support')
            ->with(
                [
                    'txId'=>$this->_transaction->wallet->hash,
                    'srcAmount'=>$amountReceived,
                    'dstAmount'=>$amountToReceive,
                    'address'=>$this->_transaction->wallet->address,
                    'first_name'=>$this->_transaction->wallet->user->first_name,
                    'family_name'=>$this->_transaction->wallet->user->family_name,
                    'card'=>$this->_transaction->card,
                    'txDate'=>$t,
                ]
            );
    }
}
