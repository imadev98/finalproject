<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {

    protected $fillable = [
        'type_v','status'

    ];

    protected $dates = [];

    public static $rules = [
       
    ];

    // Relationships

}
