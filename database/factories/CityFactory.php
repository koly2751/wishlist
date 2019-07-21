<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        //

        'name' => $faker->unique()->city,
        'country_id' => rand(1, 20),
        'charge'=>rand(50,120),
        'action'=>1
    ];
});
