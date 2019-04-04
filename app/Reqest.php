<?php 

namespace App;

//test

use Illuminate\Database\Eloquent\Model;

class Reqest extends Model {

    protected $fillable = [
        'user_id','reservation_id','dish_id','Quantity'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
