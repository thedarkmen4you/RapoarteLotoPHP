<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContoareElectronicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contoare_electronice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->date('data');
            $table->integer('aparat')->unsigned();;
            $table->double('indexInceput', 10, 2);
            $table->double('indexSfarsit', 10, 2);
            $table->double('totalImpulsuri', 8, 2);
            $table->double('pretImpuls', 8, 2);
            $table->double('valoareIncasari', 8, 2);
            $table->timestamps();
            
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('aparat')->references('id')->on('setari');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contoare_electronice');
    }
}
