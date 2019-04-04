<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ingrediant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        			
         Schema::create('additions__deliveries' , function($myTable){
            $myTable -> increments('id');
            $myTable-> integer('Addition_id')->unsigned();
            $myTable-> integer('deliveryrequest_id')->unsigned();
            $myTable-> foreign('deliveryrequest_id')->references('id')->on('reqests__deliveries')->onDelete('cascade');
            $myTable-> foreign('Addition_id')->references('id')->on('additions')->onDelete('cascade');
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
