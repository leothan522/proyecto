<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claps', function (Blueprint $table) {
            $table->string('productivo')->after('observaciones')->nullable();
            $table->string('tipo_produccion')->after('productivo')->nullable();
            $table->string('detalles_produccion')->after('tipo_produccion')->nullable();
            $table->integer('num_familias')->after('detalles_produccion')->nullable();
            $table->integer('num_lideres')->after('num_familias')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claps', function (Blueprint $table) {
            //
        });
    }
}
