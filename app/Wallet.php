<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
 	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallets';
    //

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function transactions()
    {
    	return $this->hasMany('App\Transaction', 'tx_id');
    }

}
