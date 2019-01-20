<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('num_facture');
            $table->string('designation');
            $table->float('pu');
            $table->integer('nu');
            $table->unsignedInteger('bus_id') ;
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
        Schema::dropIfExists('facture_pieces');
    }
}
