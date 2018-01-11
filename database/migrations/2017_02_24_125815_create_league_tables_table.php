<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueTablesTable extends Migration
{
    public function up()
    {
            Schema::create('league_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->tinyInteger('games')->default(0)->unsigned();
            $table->tinyInteger('wins')->default(0)->unsigned();
            $table->tinyInteger('draws')->default(0)->unsigned();
            $table->tinyInteger('losts')->default(0)->unsigned();
            $table->tinyInteger('scores')->default(0)->unsigned();
            $table->tinyInteger('missed')->default(0)->unsigned();
            $table->tinyInteger('odds')->default(0);
            $table->tinyInteger('points')->default(0);
            $table->integer('league_id')->unsigned();
            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('league_tables');
    }
}

