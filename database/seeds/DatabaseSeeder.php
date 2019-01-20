<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user::class);
        $this->call(date::class);
        $this->call(trajet::class);
        $this->call(seederChauffeur::class);
        $this->call(seederBus::class);
        $this->call(seederRepot::class);
        $this->call(seederTour::class);
        $this->call(seederFournisseur::class);
        /*facture*/
        $this->call(facture_gazoile::class);
        $this->call(seederBill::class);
        $this->call(facture_visite::class);
        $this->call(client::class);
        $this->call(facture_service::class);
        $this->call(facture_piece::class);
        /*facture*/
        
    }
}
