<?php

use Illuminate\Database\Seeder;

class facture_gazoile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(\App\facture_gazoile::class,1000)->create();
    
    }
}
