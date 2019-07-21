<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        //

        'name' => $faker->word,
        'logo' => 'jpg',
        'action'=>1,
    ];
});
