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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('twit_id');
            $table->index('twit_id','comment_twit_idx');
            $table->foreign('twit_id','comment_twit_fk')->on('twits')->references('id');

            $table->unsignedBigInteger('user_id');
            $table->index('user_id','comment_user_idx');
            $table->foreign('user_id','comment_user_fk')->on('users')->references('id');

            $table->string('text', 200);
            $table->boolean('is_answer')->default(false);

            $table->unsignedBigInteger('comment_id')->nullable();
            $table->index('comment_id','comment_comment_idx');
            $table->foreign('comment_id','comment_comment_fk')->on('comments')->references('id');

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
        Schema::dropIfExists('comments');
    }
};
