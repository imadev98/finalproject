<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    protected $fillable =[
    'table_id' , 'user_id' , 'status','arrive_at','nb_personne'


    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
