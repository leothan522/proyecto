<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLideresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lideres', function (Blueprint $table) {
            $table->bigInteger('claps_id')->after('id')->unsigned();
            $table->foreign('claps_id')->references('id')->on('claps')->cascadeOnDelete();
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
