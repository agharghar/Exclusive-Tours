<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'type' => rand(0,1)? : 'admin','user' , 

    ];
});
