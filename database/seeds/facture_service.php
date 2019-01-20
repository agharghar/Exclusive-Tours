<?php

use Illuminate\Database\Seeder;

class facture_service extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\facture_service::class,200)->create();
    }
}
