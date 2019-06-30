<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model {

    protected $fillable = [
        'message_admin','message_client'

    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
