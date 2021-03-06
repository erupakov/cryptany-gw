<?php
/**
 * CurrencyRate model
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
 * CurrencyRate model, used to represent currency exchange rate in ORM
 *
 * @category Model
 * @package  App
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */

class CurrencyRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rates';
    //
    /**
     * Function currency, return related currency model instance
     *
     * @method currency
     * @return currency model instance
     */
    public function currency()
    {
        return $this->belongsTo('App\Currency','currencyId');
    }
}
