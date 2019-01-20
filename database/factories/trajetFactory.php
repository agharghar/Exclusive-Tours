<?php

use Faker\Generator as Faker;

$factory->define(App\trajet::class, function (Faker $faker) {
    return [
        
        'from' => $faker->city ,
        'to' => $faker->city ,
        'km' => rand(10,1000) ,
    ];
});
