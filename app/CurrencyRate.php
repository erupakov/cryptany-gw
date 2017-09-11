<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
 	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rates';
    //

    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
}
