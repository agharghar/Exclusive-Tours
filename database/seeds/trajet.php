<?php

use Illuminate\Database\Seeder;

class trajet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      factory(\App\trajet::class,20)->create();

    }
}
