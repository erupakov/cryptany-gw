<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
 	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';
    //

    public function rates()
    {
    	return $this->hasMany('App\CurrencyRate');
    }
}
