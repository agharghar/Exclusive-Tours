<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;  
    
$factory->define(App\chauffeur::class, function (Faker $faker) {

    return [
        'cin' => $faker->swiftBicNumber ,
        'permis' => $faker->swiftBicNumber ,
        'nom' => $faker->lastName ,
        'prenom' => $faker->firstName ,
        'address' => filter_var ( $faker->address, FILTER_SANITIZE_STRING) ,
        'cnss' => uniqid(),
        'dossier' => hexdec(uniqid()) , 
        'num_chauffeur' => $faker->unique()->randomNumber($nbDigits = 2),
        'tele' => $faker->e164PhoneNumber ,

     
    ];
});

/* Information chauffeurs 


n°cnss 
n° dossier 
N° de chauffeurs 
N° Tele 



*/
