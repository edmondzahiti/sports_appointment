<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Field\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'name'     => $faker->name,
        'capacity' => $faker->numberBetween(50, 100),
    ];
});
