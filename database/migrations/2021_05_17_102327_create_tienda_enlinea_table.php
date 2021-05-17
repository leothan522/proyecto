<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendaEnlineaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_enlinea', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->bigInteger('parametros_id')->unsigned();
            $table->integer('familias');
            $table->float('tm');
            $table->integer('band')->default(1)->nullable();
            $table->foreign('parametros_id')->references('id')->on('parametros')->cascadeOnDelete();
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
        Schema::dropIfExists('tienda_enlinea');
    }
}
