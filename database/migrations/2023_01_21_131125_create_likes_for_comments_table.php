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
        Schema::create('likes_for_comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('comment_id');
            $table->index('comment_id','likesForComments_comment_idx');
            $table->foreign('comment_id','likesForComments_comment_fk')->on('comments')->references('id');

            $table->unsignedBigInteger('user_id');
            $table->index('user_id','likesForComments_user_idx');
            $table->foreign('user_id','likesForComments_user_fk')->on('users')->references('id');


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
        Schema::dropIfExists('likes_for_comments');
    }
};
