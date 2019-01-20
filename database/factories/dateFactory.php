<?php

use Faker\Generator as Faker;

$factory->define(App\date::class, function (Faker $faker) {
    return [
        'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) 
    ];
});
