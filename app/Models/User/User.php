<?php

namespace App\Models\User;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable
        # Custom Traits
        , ScopesTrait
        , MethodTrait
        , MutatorTrait
        , AccessorTrait
        , RelationsTrait
        ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'can_be_impersonated' => 'boolean',
    ];


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

}
