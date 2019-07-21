<?php

use Faker\Generator as Faker;

$factory->define(App\Shipping::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'phone' => rand(1,12),
        'address' =>$faker->word,
        
    ];
});
