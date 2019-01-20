<?php

use Faker\Generator as Faker;

$factory->define(\App\facture_visite::class, function (Faker $faker) {
    return [
         'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) ,
        'designation' => $faker->text('25'),
        'num_facture' => $faker->swiftBicNumber,
        'bus_id' => rand(1,20) ,
        'montant' => $faker->randomFloat(null,0,8000) ,
    
    ];
});
