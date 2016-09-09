<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBileteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilete', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->date('data');
            $table->integer('aparat')->unsigned();;
            $table->string('bilet');
            $table->string('crc');
            $table->double('castigBrut', 8, 2);
            $table->double('ramburs', 8, 2);
            $table->double('impozit', 8, 2);
            $table->double('castigNet', 8, 2);
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
        Schema::drop('bilete');
    }
}
