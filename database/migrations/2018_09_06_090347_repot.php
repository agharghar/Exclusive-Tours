<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Repot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('repots', function (Blueprint $table) {
            /*keys*/
            $table->increments('id');
            $table->unsignedInteger('chauffeur_id')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nombre_jour');
            /*keys*/

            /*Foreign key attachement */
            $table->foreign('chauffeur_id')->references('id')->on('chauffeurs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            /*Foreign key attachement */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repots');
    
    }
}



/*


date_debut | date_fin | nombre_de_jour 













*/
