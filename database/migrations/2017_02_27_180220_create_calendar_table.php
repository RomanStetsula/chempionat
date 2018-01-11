<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    public function up()
    {
            Schema::create('calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id')->unsigned();
            $table->foreign('league_id')->references('id')->on('leagues');
            $table->tinyInteger('round')->default(1);
            $table->integer('home_team_id')->unsigned();
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->integer('away_team_id')->unsigned();
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->tinyInteger('home_team_goals')->unsigned()->nullable();
            $table->tinyInteger('away_team_goals')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->integer('add_result_user_id')->unsigned()->nullable();
            $table->foreign('add_result_user_id')->references('id')->on('users');
        });
    }
    
    public function down()
    {
        Schema::drop('calendars');
    }
}
