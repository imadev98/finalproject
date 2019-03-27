<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation' , function($myTable){

            $myTable -> increments('id');
            $myTable-> integer('user_id')->unsigned();
            $myTable-> integer('table_id')->unsigned();
            $myTable-> string('status');
            $myTable-> datetime('arrive_at');
            $myTable-> foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $myTable-> foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $myTable -> timestamps();
         
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
