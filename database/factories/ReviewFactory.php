<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    
        //
        return [

        'description' => $faker->paragraph(1,true),
        'star' => rand(1,5),
        'product_id' =>rand(1,150),
        'user_id' =>rand(1,5)
           
    ];
    
});
