<?php

use Illuminate\Database\Seeder;

class seederBus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\bus::class,20)->create();
    }
}
