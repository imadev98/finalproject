<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class GestionsController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */ 
    public $k = 0;
     public function ajouter(Request $request)
    {
        $this->validate($request, [
            'position'=> 'required',
            'capacity'=> 'required',
            'status'=>'required'   
        ]);
        $position = $request->input('position');
        $capacity =$request->input('capacity');
        $status = $request->input('status');
        $table = Table::create([
            'position' => $position,
            'capacity' => $capacity,
            'status' => $status        
        ]);
        $table=Table::first();
        //$token=JWTAuth::formUser($user);
        //return Response::json( compact('token'));
        return 'Table est ajouter  !  ';
    }
    public function showall(){
        $alltables=Table::all();
        //for( $i=9 ; $i >= 10; $i++){
        //$find=$alltables[$i]->id;
        //return $i;
        //}
        //$find = Table::find(9);
                return $alltables;
    }

    public function edit($id){
        $table = Table::find($id);
//echo "$table->capacity"; 
//echo " $table->emplacment ";
//echo " $table->status";
    }
    //update Table
    public function update(Request $request , $id)
    {
        $table= Table::find($id);
        $this->validate($request, [
             'capacity' ,
             'position',
             'status'
        ]);
        $capacity =$request->input('capacity');
        $emplacment =$request->input('position');
        $status =$request->input('status');
        if($capacity!=null ){
        $table->capacity =$capacity;
       }
       if($position!=null){
          $table->position =$position;
       }
       if($status!=null){
        $table->status =$status;
       }
       $table->save();
       return 'Table updated !';
      // else return 'nothing changed !';
    }
}