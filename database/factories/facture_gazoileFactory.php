<?php

use Faker\Generator as Faker;

$factory->define(\App\facture_gazoile::class, function (Faker $faker) {
    return [
        'num_facture' => $faker->swiftBicNumber,
        'designation' => $faker->text('25'),
        'fournisseur_id' => rand(1,20) ,
    ];
});
