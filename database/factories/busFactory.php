<?php

use Faker\Generator as Faker;

$factory->define(App\bus::class, function (Faker $faker) {
    return [
        'matricule' => $faker->swiftBicNumber ,
        'num_carte_grisse' => $faker->swiftBicNumber ,
        'pv' => $faker->swiftBicNumber ,
        'autorisation_num' => $faker->swiftBicNumber ,
        'autorisation_num_dossier' => $faker->swiftBicNumber ,
        'assurance_num_odre' => $faker->swiftBicNumber ,
        'assurance_num_odre' => $faker->swiftBicNumber ,
        'date_debut' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) ,
        'date_fin' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')) ,
        'chauffeur_id' => rand(1,20) ,
    ];
});
