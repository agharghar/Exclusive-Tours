<?php

use Illuminate\Database\Seeder;

class date extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	
	   factory(\App\date::class,20)->create();

    }
}
