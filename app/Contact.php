<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $fillable = [
        'name','email','message'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}