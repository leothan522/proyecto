<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censo', function (Blueprint $table) {
            $table->id();
            $table->integer('num_familia');
            $table->string('miembro_familia');
            $table->string('nombre_completo');
            $table->string('tipo_ci')->nullable();
            $table->string('cedula')->nullable();
            $table->string('telefono_1')->nullable();
            $table->string('telefono_2')->nullable();
            $table->string('estructura_clap')->nullable();
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->bigInteger('lideres_id')->nullable()->unsigned();
            $table->foreign('lideres_id')->references('id')->on('lideres')->nullOnDelete();
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
        Schema::dropIfExists('censo');
    }
}
