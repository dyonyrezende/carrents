<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client')->unsigned();
            $table->foreign('client')->references('id')->on('clients');
            $table->integer('car')->unsigned();
            $table->foreign('car')->references('id')->on('car_models');
            $table->string('locationdate');
            $table->string('devolutiondate');
            $table->string('rentvalue');
            $table->boolean('status');
            
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
        Schema::dropIfExists('car_rents');
    }
}
