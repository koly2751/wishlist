<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        //

        'title' => $faker->word,
        'logo' => 'jpg',
        'type' =>rand(1,5),
        'action'=>1,
    ];
});
