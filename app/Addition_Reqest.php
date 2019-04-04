<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition_Reqest extends Model {

    protected $fillable = [
        'Addition_id','reqest _id'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
