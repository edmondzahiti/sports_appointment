<?php

namespace App\Models\Event;

use Carbon\Carbon;

trait AccessorTrait
{
    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H', $value)->format('m');
    }
}
