<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parametros_id')->unsigned();
            $table->bigInteger('municipios_id')->unsigned();
            $table->date('fecha_atencion');
            $table->string('tipo_entrega')->default('completa')->nullable();
            $table->foreign('parametros_id')->references('id')->on('parametros')->cascadeOnDelete();
            $table->foreign('municipios_id')->references('id')->on('municipios')->cascadeOnDelete();
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
        Schema::dropIfExists('periodos');
    }
}
