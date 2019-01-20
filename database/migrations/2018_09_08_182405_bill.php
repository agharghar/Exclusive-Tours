<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills',function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('bus_id');
            $table->unsignedInteger('facture_gazoile_id');
            $table->integer('pu')->default(0);
            $table->integer('litrage')->default(0);
            $table->string('num_carte')->default(0);
            $table->float('km')->default(0);
            $table->date('date');
            $table->float('peage_autoroute')->default(0);
            $table->float('peage_lavage')->default(0);

            $table->foreign('facture_gazoile_id')->references('id')->on('facture_gazoiles')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade')->onUpdate('cascade');   
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
        Schema::dropIfExists('bills');
    }
}
