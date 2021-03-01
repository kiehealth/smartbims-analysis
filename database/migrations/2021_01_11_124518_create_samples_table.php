<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kit_id')->unsigned()->unique();
            $table->foreign('kit_id')->references('id')->on('kits');
            $table->string('sample_id')->unique();
            $table->foreign('sample_id')->references('sample_id')->on('kits')->onUpdate('cascade');
            $table->string('lab_id')->unique()->nullable();
            $table->date('sample_registered_date');
            $table->string('cobas_result')->nullable();
            $table->date('cobas_analysis_date')->nullable();
            $table->string('luminex_result')->nullable();
            $table->date('luminex_analysis_date')->nullable();
            $table->string('rtpcr_result')->nullable();
            $table->date('rtpcr_analysis_date')->nullable();
            $table->string('final_reporting_result')->nullable();
            $table->date('reporting_date')->nullable();
            $table->string('reported_via')->nullable();
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
        Schema::dropIfExists('samples');
    }
}
