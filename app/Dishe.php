<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Dishe extends Model {

    protected $fillable = [
        'name','Ingredients','price','Quantity','Category'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
