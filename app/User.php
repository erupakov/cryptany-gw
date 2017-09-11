<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'appToken'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

 	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    //

    public function wallets()
    {
        return $this->hasMany('App\Wallet');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function events()
    {
        return $this->hasMany('App\UserEvent');
    }

    public function verifications()
    {
        return $this->hasMany('App\UserVerification');
    }
}
