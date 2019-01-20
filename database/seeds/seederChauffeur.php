<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class seederChauffeur extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\chauffeur::class,20)->create();

    }
}
