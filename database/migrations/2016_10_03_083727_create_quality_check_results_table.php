<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualityCheckResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_check_results', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('monitor_id');
            $table->integer('url_id');
            $table->integer('quality_check_id');
            $table->integer('result');
            $table->string('result_message');
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
        Schema::drop('quality_check_results');
    }
}
