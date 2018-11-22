<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostLikeDislike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_dislike', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('blog_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');;

            $table->integer('like_dislike');
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
        Schema::dropIfExists('like_dislike');
    }
}
