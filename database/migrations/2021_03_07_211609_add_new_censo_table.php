<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('censo', function (Blueprint $table) {
            $table->string('cdlp')->after('lideres_id')->nullable();
            $table->text('observaciones')->after('cdlp')->nullable();
            $table->text('import_id')->after('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('censo', function (Blueprint $table) {
            //
        });
    }
}
