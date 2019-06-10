<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reduction extends Model {

    protected $fillable = [

       	'start_date',	'end_date',	'values',	'Reason'	

    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
