<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
 public function up()
  {
        Schema::create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('subtitle')->nullable();
        $table->string('author')->nullable();
        $table->string('main_img')->nullable();
        $table->string('thumbs_img')->nullable();
        $table->text('content');
        $table->dateTime('created_at');
        $table->integer('user_id')->unsigned()->nullable();
        $table->foreign('user_id')->references('id')->on('users');
    });
  }

  public function down()
  {
      Schema::drop('posts');
  }
}
