<?php

namespace App\Models;

use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

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

    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H', $value)->format('m');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

}
