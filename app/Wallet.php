<?php
/**
 * Wallet model
 * PHP Version 7
 *
 * @category Model
 * @package  App\Http\Model
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Wallet model, used to manipulate any wallet in the system
 *
 * @category Model
 * @package  App\Http\Model
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class Wallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallets';
    //

    /**
     * Owner of the wallet.
     *
     * @var string
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * APIUser that was used to generate wallet.
     *
     * @var string
     *
     * @return App\APIUser
     */
    public function apiuser()
    {
         return $this->belongsTo('App\APIUser');
    }
 
    /**
     * Link to transactions associated with this wallet
     *
     * @var string
     *
     * @return App\Transaction     
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'walletId');
    }
}
