<?php

namespace App\Models\Field;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use ScopesTrait
        , MethodTrait
        , RelationsTrait
        , MutatorTrait
        , AccessorTrait
    ;

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'capacity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


}
