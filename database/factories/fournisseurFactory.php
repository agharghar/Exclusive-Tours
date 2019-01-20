<?php

use Faker\Generator as Faker;

$factory->define(\App\fournisseur::class, function (Faker $faker) {
    return [
        'nomFournisseur' => $faker->company ,
    ];
});
