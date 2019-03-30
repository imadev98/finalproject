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
                foreach($alltables as  $all){
                    echo "Table '$all->id'";
                }
        
        

    }

    public function edit($id){
        $table = Table::find($id);
        
        
      
       

//echo "$table->capacity"; 
//echo " $table->emplacment ";
//echo " $table->status";
    }


      

    public function showBySort(){
      
       
    }



     




    //update Table
    public function update(Request $request , $id)
    {
        $table= Table::find($id);
        $this->validate($request, [
             
             'capacity' ,
             'emplacment',
             'status'
           
        ]);
        $capacity =$request->input('capacity');
        $emplacment =$request->input('emplacment');
        $status =$request->input('status');
        if($capacity!=null ){
        $table->capacity =$capacity;
       }
       if($emplacment!=null){
          $table->emplacment =$emplacment;
       }
       if($status!=null){
        $table->status =$status;
       }
       $table->save();
       return 'Table updated !';
      // else return 'nothing changed !';
    }
}