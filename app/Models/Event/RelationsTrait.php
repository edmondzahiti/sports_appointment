<?php

namespace App\Models\Event;

use App\Models\Field;

trait RelationsTrait
{

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
}
