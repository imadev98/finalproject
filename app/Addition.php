<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model {

    protected $fillable = [

        'name'	,'prix'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
