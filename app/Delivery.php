<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model {

    protected $fillable = [
        'user_id','deliverer _id','vehicle_id','Address','delivery_at','status'
    ];

    protected $dates = [];

    public static $rules = [
        
    ];

    // Relationships

}
