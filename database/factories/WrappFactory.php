<?php

use Faker\Generator as Faker;

$factory->define(App\Wrapp::class, function (Faker $faker) {
    return [
        //

        'name' => $faker->word,
        'image' => 'jpg',
        'price' =>rand(100,240),
        'action' => 1,
        
    ];
});
