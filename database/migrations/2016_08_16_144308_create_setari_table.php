<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->string('type');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('setari');
    }
}
