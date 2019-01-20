<?php

use Faker\Generator as Faker;

$factory->define(\App\repot::class, function (Faker $faker) {
    return [
        'chauffeur_id' => rand(1,20) ,
        'nombre_jour' => rand(1,30) ,
        'date_fin' => $faker->date ,
        'date_debut' => $faker->date ,
    ];
});
