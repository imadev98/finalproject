<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

    protected $fillable = [

        'position','capacity', 'price'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
