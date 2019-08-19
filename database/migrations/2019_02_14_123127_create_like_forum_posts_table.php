<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeForumPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_forum_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('forum_post_id');
            $table->foreign('forum_post_id')->references('id')->on('forum_posts')->onDelete('cascade');

            $table->timestamps();
            //make sure that there can't be more than one entry in the database with this value - prevent users from liking the same thing twice
            $table->unique(['user_id', 'forum_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_forum_posts');
    }
}
