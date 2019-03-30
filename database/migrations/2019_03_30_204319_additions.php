<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Additions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Additions_Reqest' , function($myTable){
            $myTable -> increments('id');
            $myTable-> integer('Addition_id')->unsigned();
            $myTable-> integer('reqest _id')->unsigned();
            $myTable-> foreign('Addition_id')->references('id')->on('Additions')->onDelete('cascade');
            $myTable-> foreign('reqest _id')->references('id')->on('reqests')->onDelete('cascade');
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
        //
    }
}
