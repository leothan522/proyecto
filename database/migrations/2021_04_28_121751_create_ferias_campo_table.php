<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeriasCampoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias_campo', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->bigInteger('municipios_id')->unsigned();
            $table->bigInteger('parroquias_id')->unsigned();
            $table->integer('familias');
            $table->float('tm');
            $table->foreign('municipios_id')->references('id')->on('municipios')->cascadeOnDelete();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->cascadeOnDelete();
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
        Schema::dropIfExists('ferias_campo');
    }
}
