//test

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reqest extends Model {

    protected $fillable = [
        'user_id','reservation_id','dish_id','Additions','Quantity'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
