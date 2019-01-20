<?php

use Faker\Generator as Faker;

$factory->define(\App\bill::class, function (Faker $faker) {
    return [
        
    	'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) ,
        'pu' => $faker->randomFloat(null,0,8000),
        'litrage' => rand(0,200) ,
        'km' => rand(0,200) ,
        'num_carte' => rand(0,200) ,
        'peage_autoroute' => $faker->randomFloat(null,0,8000),
        'peage_lavage' => $faker->randomFloat(null,0,8000),
        'bus_id' => rand(1,20),
        'facture_gazoile_id' => rand(1,1000),

    ];
});
