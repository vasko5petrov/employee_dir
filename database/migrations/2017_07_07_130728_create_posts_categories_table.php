<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create posts categories tables
        Schema::dropIfExists('posts_categories');
        Schema::create('posts_categories', function(Blueprint $tables) {
            $tables->increments('id');
            $tables->string('name');
            $tables->integer('importance')->nullable();
            $tables->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts_categories');
    }
}
