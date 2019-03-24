<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

    protected $fillable = [

        'emplacment','capacity', 'status'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
