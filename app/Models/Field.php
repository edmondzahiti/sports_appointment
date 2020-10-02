<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{

    protected $guarded = [
        'id',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'field_id', 'id');
    }
}
