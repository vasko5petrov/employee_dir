<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create departments tables
        Schema::dropIfExists('departments');
        Schema::create('departments', function(Blueprint $tables) {
            $tables->increments('id');
            $tables->string('name');
            $tables->string('office_number');
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
        //
    }
}
