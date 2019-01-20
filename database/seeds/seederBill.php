<?php

use Illuminate\Database\Seeder;

class seederBill extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\bill::class,10000)->create();
    }
}
