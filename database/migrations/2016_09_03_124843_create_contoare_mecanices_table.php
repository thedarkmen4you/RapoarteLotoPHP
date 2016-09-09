<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContoareMecanicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contoare_mecanice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->date('data');
            $table->integer('aparat')->unsigned();;
            $table->double('in', 10, 0);
            $table->double('out', 10, 0);
            $table->double('bet', 8, 0);
            $table->double('win', 8, 0);
            $table->double('games', 8, 0);
            $table->double('remonte', 8, 0);
            $table->double('handPay', 8, 0);
            $table->double('bills', 8, 0);
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
        Schema::drop('contoare_mecanice');
    }
}
