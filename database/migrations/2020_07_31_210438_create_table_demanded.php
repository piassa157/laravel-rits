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
            $table->string('status');
            $table->string('products_ids');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
            $table->softDeletes('canceled_at', 0);
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
