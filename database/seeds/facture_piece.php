<?php

use Illuminate\Database\Seeder;

class facture_piece extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(\App\facture_piece::class,20)->create();

    }
}
