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
        			
         Schema::create('reductions' , function($myTable){
            $myTable -> increments('id');
            $myTable-> integer('date');
            $myTable-> integer('values');
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
