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
        Schema::create('deliverys' , function($myTable){

            $myTable -> increments('id');
            $myTable-> integer('user_id')->unsigned();
            $myTable-> integer('deliverer _id')->unsigned();
            $myTable-> integer('vehicle_id')->unsigned();
            $myTable-> string('Address');
            $myTable-> string('delivery_at');
            $myTable-> string('status');
            $myTable-> foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $myTable-> foreign('deliverer _id')->references('id')->on('users')->onDelete('cascade');
            $myTable-> foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
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
