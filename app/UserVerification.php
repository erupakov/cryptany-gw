<?php
/**
 * User verification model
 * PHP Version 7
 *
 * @category Model
 * @package  App\Http\Model
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * User verification model -- handles processing user email verification codes
 *
 * @category Model
 * @package  App\Http\Model
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_verifications';
    //

    /**
     * Method user, return related user model instance
     *
     * @method currency
     * @return currency model instance
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
