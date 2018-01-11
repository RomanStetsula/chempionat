<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('city', 40);
            $table->string('logo')->nullable();
            $table->string('small_logo')->nullable();
            $table->string('foto')->nullable();
            $table->string('president', 40)->nullable();
            $table->string('manager', 40)->nullable();
            $table->string('manager_num', 20)->nullable();
            $table->string('web', 40)->nullable();
            $table->text('info')->nullable();
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teams');//
    }
}
