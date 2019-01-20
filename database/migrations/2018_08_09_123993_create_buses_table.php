<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule');
            $table->string('num_carte_grisse');
            $table->string('pv');
            $table->string('autorisation_num');
            $table->string('autorisation_num_dossier');
            $table->string('assurance_num_odre');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedInteger('chauffeur_id')->nullable();
            $table->foreign('chauffeur_id')->references('id')->on('chauffeurs')->onUpdate('cascade')->onDelete('set null');   
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('buses');
    }
}


/* 

N° carte Grisse

PV 


Carte d'autorisation  {
    N° Autorisation
    N° dossier 
}


Assurance {
    
    Num Ordre
    Date Début / Fin 

}
*/