<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model {

    protected $fillable = [

        'day','open_in','close_in','exception'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
