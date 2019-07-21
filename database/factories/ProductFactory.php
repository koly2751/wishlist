<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'price' =>rand(500,2400),
        'brand_id' =>rand(1,5),
        'subcategory_id' =>rand(1,14),
        'stock' => 0, 
        'type' =>rand(1,9),
        'offer' =>rand(1,5),
        'action'=>1

    ];
});