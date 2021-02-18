<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event\Event;
use App\Models\Field\Field;
use App\Models\User\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name'        => 'name',
        'start_time'  => Carbon::tomorrow()->format('Y-m-d'),
        'end_time'    => Carbon::tomorrow()->format('Y-m-d'),
        'field_id'    => factory(Field::class),
        'user_id'     => factory(User::class),
    ];
});
