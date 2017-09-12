<?php
/**
 * Session model, represent user session in ORM
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
 * Session  model, used to represent user sessions in ORM
 *
 * @category Model
 * @package  App
 * @class    Session
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class Session extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * Function transaction, return transaction model instance
     *
     * @function transaction
     * @return   transaction model instance
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
