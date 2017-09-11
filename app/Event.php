<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
 	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tx_events';
    //

    public function event()
    {
    	return $this->belongsTo('App\Transaction');
    }
}
