<?php

namespace App\Traits;

use App\Models\Field\Field;
use App\Models\User\User;
use Carbon\Carbon;

trait EventTestInputs
{
    /**
     * @return array
     */
    public function getEventValidInputs()
    {
        return [
            'hour'     => Carbon::tomorrow()->format('h'),
            'date'     => Carbon::tomorrow()->format('Y-m-d'),
            'user'     => auth()->user()->id,
        ];
    }

    /**
     * @return array
     */
    public function getEventInvalidInputs()
    {
        return [
            'hour'     => Carbon::tomorrow()->format('h'),
            'date'     => Carbon::tomorrow()->format('Y-m-d'),
            'field_id' => factory(Field::class),
            'user'     => factory(User::class),
        ];
    }
}
