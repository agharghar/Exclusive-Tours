<?php

use Faker\Generator as Faker;

$factory->define(\App\tour::class, function (Faker $faker) {
    return [
        'bus_id' => rand(1,20) ,
        'date_id' => rand(1,20) ,
        'trajet_id' => rand(1,20) ,
    ];
});
