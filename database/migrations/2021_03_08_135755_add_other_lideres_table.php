<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherLideresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lideres', function (Blueprint $table) {
            $table->bigInteger('municipios_id')->after('import_id')->unsigned()->nullable();
            $table->bigInteger('parroquias_id')->after('municipios_id')->unsigned()->nullable();
            $table->foreign('municipios_id')->references('id')->on('municipios')->cascadeOnDelete();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lideres', function (Blueprint $table) {
            //
        });
    }
}
