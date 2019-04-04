<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;
class GestionsController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */ 
     //Add_one_table
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
        
        
        return 'Table est ajouter  !  ';
    }
    
  //show_all_table
    public function showall(){
        
        $alltables=Table::select('id','position','capacity','status')->get();
        return $alltables;
    }

    public function edit($id){
        $table = Table::find($id);
               return $table;
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
        $position =$request->input('position');
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
    public function delete($name , $id)
    {
        $table= DB::table("$name")->find($id);
        $table->deleted = false;
        $table->save();
        return " '$name' Deleted!";
      
    }
    public function restore($name , $id)
    {
        $table= DB::table("$name")->find($id);
        $table->deleted = true;
        $table->save();
        return " '$name' restored!";
      
    }


}