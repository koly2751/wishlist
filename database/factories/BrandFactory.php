<?php

use Faker\Generator as Faker;

$factory->define(App\Brand::class, function (Faker $faker) {
    return [

    	'name' => $faker->word,
        'logo' => 'jpg',
        'banner' =>'jpg',
        'action'=>1,
        
    ];
});
