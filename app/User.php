<?php

namespace App;

use App\Events\UserRegisteredEvent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Event;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * User model
 *
 * @package App
 *
 * @property string $type       Type of user
 * @property string $email      User email
 * @property string $password   Password
 * @property string $chash      Used when changing password
 * @property int    $id         User id
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * User is basic user
     */
    const TYPE_USER = 'role2';

    /**
     * User is admin
     */
    const TYPE_ADMIN = 'role1';

    /**
     * Sets table for the model
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
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
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [
            'userid' => $this->id,
            'type' => $this->type,
            'email' => $this->email
        ];
    }

    /**
     * @inheritDoc
     */
    public function save(array $options = [])
    {
        $original_id = $this->id;
        $ret = parent::save($options);
        if ($ret && !$original_id) {
            event(
                new UserRegisteredEvent($this)
            );
        }
        return $ret;
    }

    /**
     * Get the related todo items
     */
    public function todo()
    {
        return $this->hasMany('App\Todo');
    }

    /**
     * Get the related log items
     */
    public function log()
    {
        return $this->hasMany('App\Log');
    }

    /**
     * Creates withCHash method
     *
     * @param Builder $query
     * @param string $chash
     *
     * @return Model|null
     */
    public function scopeWithCHash(Builder $query, string $chash) {
        return $query->where('chash', $chash)->first();
    }
}