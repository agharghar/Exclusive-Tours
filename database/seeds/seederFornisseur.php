<?php

use Illuminate\Database\Seeder;

class seederFournisseur extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\fournisseur::class,20)->create();
    }
}
