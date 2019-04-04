<?php 

namespace App;

//test

use Illuminate\Database\Eloquent\Model;

class Reqests_Delivery extends Model {

    protected $fillable = [
        'user_id','delivery_id','dish_id','Quantity'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
