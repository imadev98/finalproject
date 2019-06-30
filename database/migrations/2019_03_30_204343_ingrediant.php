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
        			
         Schema::create('mails' , function($myTable){
            $myTable -> increments('id');
            $myTable-> string('message_admin');
            $myTable-> string('message_client');
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
