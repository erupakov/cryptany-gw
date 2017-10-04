<?php
/**
 * Transaction events model, represent transaction events in ORM
 * PHP Version 7
 *
 * @category Model
 * @package  App
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Transaction events model, represent transaction events in ORM
 *
 * @category Model
 * @package  App
 * @class    TxEvent
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class TxEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tx_events';
    //
    /**
     * Function transaction, return transaction model instance
     *
     * @function transaction
     * @return   transaction model instance
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction','id','tx_id');
    }
}
