<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    public function up()
    {
            Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('league_name', 40);
            $table->smallInteger('season')->unsigned();
            $table->tinyInteger('rank')->unsigned();
            $table->boolean('show')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::drop('leagues');//
    }
}

