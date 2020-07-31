<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDemanded extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandeds', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total');
            $table->string('status');
            $table->integer('amount');
            $table->string('products_ids');
            $table->unsignedBigInteger('user_id');

            $table->timestamps(); //created_at
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demanded');
    }
}
