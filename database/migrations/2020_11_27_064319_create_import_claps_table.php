<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportClapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_claps', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_clap')->nullable();
            $table->string('programa')->default('CLAP');
            $table->string('municipios_id')->nullable();
            $table->string('parroquias_id')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('codigo_spda')->nullable();
            $table->string('codigo_sica')->nullable();
            $table->string('bloques_id')->nullable();
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
            $table->foreign('import_id')->references('id')->on('parametros')->nullOnDelete();
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
        Schema::dropIfExists('import_claps');
    }
}
