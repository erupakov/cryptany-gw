<?php
/**
 * Ethereum blockchain actions controller
 * PHP Version 7
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Transaction status enumeration
 *
 */
abstract class TransactionStatus
{  
    const CREATED = 1;
    const UNCONFIRMED = 2;
    const CONFIRMED = 3;
    const PROCESSING = 4;
    const PROCESSED = 5;
    const PAID = 6;
    const CLOSED = 7;
}

/**
 * Returns status of the transaction given its hash
 *
 * @param \Illuminate\Http\Request $request Request to process
 * @param string                   $hash    Transaction hash to check
 *
 * @method getTxStatus
 *
 * @return nothing
 */
class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    // Statuses:
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'txHash'
    ];

    /**
     * Method returning wallet object associated with transaction
     *
     * @method wallet
     *
     * @return App\Wallet object
     */
    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'walletId');
    }

    /**
     * Method returning session object associated with transaction
     *
     * @method session
     *
     * @return App\Session object
     */    
    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    /**
     * Method returning transaction events objects associated with transaction
     *
     * @method events
     *
     * @return App\TxEvent collection
     */    
    public function events()
    {
        return $this->hasMany('App\TxEvent');
    }

}
