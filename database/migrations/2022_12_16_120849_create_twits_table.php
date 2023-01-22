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
        Schema::create('twits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->index('user_id','twit_user_idx');
            $table->foreign('user_id','twit_user_fk')->on('users')->references('id');

            $table->string("text",400);
            $table->boolean("retwit")->default(false);

            $table->unsignedBigInteger("original_twit")->nullable();
            $table->index("original_twit","twit_twit_idx");
            $table->foreign("original_twit","twit_twit_fk")->on("twits")->references("id");

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
        Schema::dropIfExists('twits');
    }
};
