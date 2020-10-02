<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    /**
     * Get the user that this profile belong to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
