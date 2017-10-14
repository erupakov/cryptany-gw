<?php
/**
 * Data generic blockchain actions controller
 * PHP Version 7
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */

namespace App\Http\Controllers;

use \App\User;
use \App\APIUser;
use \App\CurrencyRate;
use \Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Data actions controller, used to perform generic actions 
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class DataController extends Controller
{
    /**
     * Method for handling creation of new transient wallet API method
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method getRates
     *
     * @return nothing
     */
    public function getRates(\Illuminate\Http\Request $request)
    {
		$cr = \App\CurrencyRate::where(['currencyId' => 4])->orderby('rateDate','desc')->first();

        return json_encode(['rate'=> $cr->rateValue, 'date'=> $cr->rateDate ]);
    }

    /**
     * Method for handling creation of new transient wallet API method
     *
     * @param \Illuminate\Http\Request $request Request to process
     *
     * @method regAPIUser
     *
     * @return nothing
     */
    public function regAPIUser(\Illuminate\Http\Request $request)
    {
		// Create test API user for magento user
		$apiu = new \App\APIUser;
		$apiu->appToken = $request->input('secret');
		$apiu->username = $request->input('id');
		$apiu->description = 'payment button merchant';
		$apiu->expiryDate = Carbon::now()->addYear();
		$apiu->isActive = true;
		$apiu->useTestChain = false;
		$apiu->save();

        return 'OK';
    }
}
