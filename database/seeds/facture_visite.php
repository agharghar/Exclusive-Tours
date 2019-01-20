<?php

use Illuminate\Database\Seeder;

class facture_visite extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            factory(\App\facture_visite::class,20)->create();
    }
}
