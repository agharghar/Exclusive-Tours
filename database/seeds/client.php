<?php

use Illuminate\Database\Seeder;

class client extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\client::class,20)->create();
        
    }
}
