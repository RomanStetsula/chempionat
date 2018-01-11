<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubmitResultsColumsToCal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function($table){
          $table->integer('submit1_user_id')->nullable();
          $table->integer('submit2_user_id')->nullable();
          $table->boolean('confirmed')->default(FALSE);
        });
    }

    public function down()
    {
        Schema::table('calendars', function($table){
          $table->dropColumn('submit1_user_id');
          $table->dropColumn('submit2_user_id');
          $table->dropColumn('confirmed');
        });
    }
}
