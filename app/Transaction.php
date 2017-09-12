<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    //

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function events()
    {
        return $this->hasMany('App\TxEvent');
    }

}
