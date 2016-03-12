<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trades', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('trade_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trade_id')->references('id')->on('trades');
            $table->integer('user_position')->unsigned();
            $table->float('risk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_trades');
    }
}
