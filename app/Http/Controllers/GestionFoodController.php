<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Addition;
use App\Dishe;
use App\User;
use App\Vehicle;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class GestionFoodController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */ public function AddDishe(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'Ingredients'=>'required',
            'prix'=>'required',
            'Quantity'=>'required',
            'Category'=>'required'
        ]);
        $Dishe = Dishe::create([
            'name'=>$request->input('name'),
            'Ingredients'=> $request->input('Ingredients'),
            'prix'=>$request->input('prix'),
            'Quantity'=> $request->input('Quantity'),
            'Category'=>$request->input('Category')      
        ]);
        return 'Well Dishe Added  !  ';
    }
    
     public function ShowDishes(){  
        $allDishes=Dishe::all();
        return response()->json($allDishes);
            }

            public function ShowDishe($id){  
                $Dishe=Dishe::find($id);
                return $Dishe;
             }

     public function update(Request $request , $id){

        $Dishe= Dishe::find($id);
        $this->validate($request, [
            'name',
            'Ingredients',
            'prix',
            'Quantity',
            'Category'
        ]);
        $name =$request->input('name');
        $Ingredients =$request->input('Ingredients');
        $prix =$request->input('prix');
        $Quantity =$request->input('Quantity');
        $Category =$request->input('Category');
        if($name!=null ){
        $Dishe->name =$name;
       }
       if($Ingredients!=null){
          $Dishe->Ingredients =$Ingredients;
       }
       if($prix !=null){
        $Dishe->prix  =$prix ;
       }
       if($Quantity!=null){
        $Dishe->Quantity =$Quantity;
     }
     if($Category !=null){
      $Dishe->Category  =$Category ;
     }
       $Dishe->save();
       return 'Dishe updated !';
      // else return 'nothing changed !';
    }
    public function deletedish( $id)
    {
        $Dishe= Dishe::where('id',$id)->delete();
        return response()->json(" Dishe Deleted!");
    }

    /*
    *  All Operation in Addtition
    *
    */

    public function AddAddition(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'prix'=>'required'
           
        ]);
        $Addition = Addition::create([
            'name'=>$request->input('name'),
            'prix'=>$request->input('prix')
        ]);
        return 'Well Addition Added  !  ';
    }
    
     public function ShowAdditions(){  
        $allAddition=Addition::select('name','prix')->get();
        return $allAddition;
            }

  public function ShowAddition($id){  
                $Addition=Addition::find($id);
                return $Dishe;
             }

public function updateAddition(Request $request , $id)
    {
        $Addition= Addition::find($id);
        $this->validate($request, [
            'name',
            'prix'
        ]);
        $name =$request->input('name');
        $prix =$request->input('prix');
        if($name!=null ){
        $Addition->name =$name;
       }
       if($prix !=null){
        $Addition->prix  =$prix ;
       }
   
       $Addition->save();
       return 'Addition updated !';
      // else return 'nothing changed !';
    }

     



    /*
    *  All Operation in Vehicle
    *
    */

    public function AddVehicle(Request $request)
    {
        $this->validate($request, [
            'type_v'=>'required',
        ]);
        $Vehicle = Vehicle::create([
            'type_v'=>$request->input('type_v'),
        ]);
        return 'Well Vehicle Added  !  ';
    }
    
     public function ShowVehicles(){  
        $allVehicle=Vehicle::select('type_v','status')->get();
        return $allVehicle;
            }

  public function ShowVehicle($id){  
                $Vehicle=Vehicle::find($id);
                return $Vehicle;
             }

public function updateVehicle(Request $request , $id)
    {
        $Vehicle= Vehicle::find($id);
        $this->validate($request, [
            'type_v',
            'status'
        ]);
        $type_v =$request->input('type_v');
        $status=$request->input('status');
        if($type_v!=null ){
        $Vehicle->type_v =$type_v;
       }
       if($prix !=null){
        $Vehicle->status  =$status ;
       }
   
       $Vehicle->save();
       return 'Vehicle updated !';
      // else return 'nothing changed !';
    }
      
    
}
