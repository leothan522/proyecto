<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claps', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_clap');
            $table->string('programa')->default('CLAP');
            $table->bigInteger('municipios_id')->unsigned()->nullable();
            $table->bigInteger('parroquias_id')->unsigned()->nullable();
            $table->string('comunidad')->nullable();
            $table->string('codigo_spda')->nullable();
            $table->string('codigo_sica')->nullable();
            $table->bigInteger('bloques_id')->unsigned()->nullable();
            $table->string('cedula_lider')->nullable();
            $table->string('primer_nombre_lider')->nullable();
            $table->string('segundo_nombre_lider')->nullable();
            $table->string('primer_apellido_lider')->nullable();
            $table->string('segundo_apellido_lider')->nullable();
            $table->string('nacionalidad_lider')->nullable();
            $table->string('genero')->nullable();
            $table->date('fecha_nac_lider')->nullable();
            $table->string('profesion_lider')->nullable();
            $table->string('trabajo_lider')->nullable();
            $table->string('telefono_1_lider')->nullable();
            $table->string('telefono_2_lider')->nullable();
            $table->string('email_lider')->nullable();
            $table->string('estatus_lider')->nullable();
            $table->text('direccion')->nullable();
            $table->string('longitud')->nullable();
            $table->string('latitud')->nullable();
            $table->string('google_maps')->nullable();
            $table->text('observaciones')->nullable();
            $table->bigInteger('import_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->foreign('import_id')->references('id')->on('parametros')->nullOnDelete();
            $table->foreign('bloques_id')->references('id')->on('parametros')->nullOnDelete();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->nullOnDelete();
            $table->foreign('municipios_id')->references('id')->on('municipios')->nullOnDelete();
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
        Schema::dropIfExists('claps');
    }
}
