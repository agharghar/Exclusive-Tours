<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactureGazoilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_gazoiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_facture');
            $table->string('designation');
            $table->unsignedInteger('fournisseur_id')->nullable() ;
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade')->onUpdate('cascade');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture_gazoiles');
    }
}
