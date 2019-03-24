<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests' , function($myTable){

            $myTable -> increments('id');
            $myTable-> integer('user_id')->unsigned();
            $myTable-> integer('reservation_id')->unsigned();
            $myTable-> integer('dish_id')->unsigned();
            $myTable-> string('Additions');
            $myTable-> foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $myTable-> foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $myTable-> foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
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
        $myTable->dropForeign('user_id');
        $myTable->dropForeign('table_id');
        Schema::dropIfExists('reservations');
    }
}
