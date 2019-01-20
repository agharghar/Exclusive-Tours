<?php

use Faker\Generator as Faker;

$factory->define(\App\facture_service::class, function (Faker $faker) {
    return [
        'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) ,
        'designation' => $faker->text('25'),
        'num_facture' => $faker->swiftBicNumber,
        'client_id' => rand(1,20) ,
        'etat' => rand(0,1) ,
        'montant' => $faker->randomFloat(null,0,8000) ,

    ];
});




        // fill the factory and the seeder and test Migration/seeding + verify relation
