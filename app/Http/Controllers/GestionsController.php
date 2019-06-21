<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use App\Work;
use App\Contact;
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
            'price' => 'required'
            
        ]);
        $position = $request->input('position');
        $capacity =$request->input('capacity');
        $price =$request->input('price');
        $table = Table::create([
            'position' => $position,
            'capacity' => $capacity,
                'price' => $price  
        ]);
        
        
        return response()->json('Table est ajouter  !');
    }
    
  //show_all_table
    public function showall(){
        
        $alltables=Table::select('id','position','capacity')->get();
        return response()->json($alltables);
    }

    public function show($id){
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
             'price'
            
        ]);
        $capacity =$request->input('capacity');
        $position =$request->input('position');
        $price =$request->input('price');
        if($capacity!=null ){
        $table->capacity =$capacity;
       }
       if($position!=null){
          $table->position =$position;
       }
       if($price!=null){
        $table->price =$price;
     }
       
       $table->save();
       return 'Table updated !';
      // else return 'nothing changed !';
    }
    public function delete( $id)
    {
        $table= Table::where('id',$id)->delete();
        return response()->json(" table Deleted!");
    }

    


    public function add_time(Request $request)
    {
        $this->validate($request, [
            'day'=> 'required',
            'open_in'=> 'required',
            'close_in'=>'required'   
        ]);
        $day= $request->input('day');
        $open_in =$request->input('open_in');
        $close_in = $request->input('close_in');
        $time = Work::create([
            'day' => $day,
            'open_in' => $open_in,
            'close_in' => $close_in        
        ]);
        
    
        return response()->json('Time Added !  ');
    }

    public function update_time(Request $request , $id)
    {
        $time= Work::find($id);
        $this->validate($request, [
             'open_in',
             'close_in'
             
        ]);
        
        $open_in =$request->input('open_in');
        
        $close_in =$request->input('close_in');
        
        if($open_in!=null ){
        $time->open_in =$open_in;
       }
       if($close_in!=null){
          $time->close_in =$close_in;
       }
       
        $time->exception =null;
     

       $time->save();
       return response()->json('time updated !');
      
    }

    public function add_exception(Request $request )
    {
        
        $this->validate($request, [
            'day',
            'exception'
        ]);
        
        $exception =$request->input('exception');
        $day =$request->input('day');

        $time= Work::where('day','=',$day)->first();
        if($exception!=null ){
        $time->exception =$exception;
        }
       $time->save();
       return response()->json('Expception Added !');
      
    }

    public function showall_Work(){
        
        $allworks=Work::select('id','day','open_in','close_in','exception')->get();
        return $allworks;
    }
    

    public function Contact(Request $request){
    
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|max:255',
            'message'=>'required'   
        ]);
        $name= $request->input('name');
        $email =$request->input('email');
        $message = $request->input('message');
        $time = Contact::create([
            'name' => $name,
            'email' => $email,
            'message' => $message        
        ]);
        
        
        return 'thanks for ur message !  ';
    }
}