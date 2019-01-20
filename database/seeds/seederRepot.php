<?php

use Illuminate\Database\Seeder;

class seederRepot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\repot::class,20)->create();

    }
}
