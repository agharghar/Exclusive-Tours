<?php

use Illuminate\Database\Seeder;

class seederTour extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\tour::class,1000)->create();
        
    }
}
