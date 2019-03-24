<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Dishe extends Model {

    protected $fillable = [
        'name_dish','Ingredients','prix'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
