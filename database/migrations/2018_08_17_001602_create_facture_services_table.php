<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactureServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_services', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('num_facture');
            $table->string('designation');
            $table->boolean('etat');
            $table->float('montant');
            $table->unsignedInteger('client_id')->nullable() ;
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');   
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
        Schema::dropIfExists('facture_services');
    }
}
