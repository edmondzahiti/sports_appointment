<?php

namespace App\Models\Field;

use App\Models\Event\Event;

trait RelationsTrait
{
    public function events()
    {
        return $this->hasMany(Event::class, 'field_id', 'id');
    }
}
