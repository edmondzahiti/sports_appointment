<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use ScopesTrait
        , MethodTrait
        , RelationsTrait
        , MutatorTrait
        , AccessorTrait
        , SoftDeletes
    ;


    public $primaryKey = 'id';
    public $table = 'events';

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'field_id',
        'user_id',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
