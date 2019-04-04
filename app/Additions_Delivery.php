<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Additions_Delivery extends Model {

    protected $fillable = [
        'deliveryrequest_id','Addition_id'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
