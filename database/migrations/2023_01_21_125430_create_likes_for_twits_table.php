<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_for_twits', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('twit_id');
            $table->index('twit_id','likesForTwit_twit_idx');
            $table->foreign('twit_id','likesForTwit_twit_fk')->on('twits')->references('id');

            $table->unsignedBigInteger('user_id');
            $table->index('user_id','likesForTwit_user_idx');
            $table->foreign('user_id','likesForTwit_user_fk')->on('users')->references('id');


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
        Schema::dropIfExists('likes_for_twits');
    }
};
