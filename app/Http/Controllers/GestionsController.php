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
     */    public function ajouter(Request $request)
    {

        
        $this->validate($request, [
            'emplacment'=> 'required',
            'capacity'=> 'required',
            'status'=>'required'
            
        ]);

        $emplacment = $request->input('emplacment');
        $capacity =$request->input('capacity');
        $status = $request->input('status');
        $table = Table::create([
            'emplacment' => $emplacment,
            'capacity' => $capacity,
            'status' => $status,
        
        ]);

       
      
        $table=Table::first();
        //$token=JWTAuth::formUser($user);
        //return Response::json( compact('token'));
        return 'Table est ajouter  !  ';
    }
   

    public function showall(){

        $alltables=Table::all();
        return $alltables;

    }







    //update Table
    public function update(Request $request , Table $table)
    {

        $this->validate($request, [
             'id'  => 'required',
            'capacity'
           
            
        ]);

        
        
        $table= Table::find($request->input('id'));
        $capacity =$request->input('capacity');
        if($capacity!=null){
        $table->capacity =$capacity ;
       } else return 'you have insert capacity !';
      
        $table->save();
            
           
            
     
      
        return 'Table updated !  ';
    }
}