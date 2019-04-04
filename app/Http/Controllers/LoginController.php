<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class UserController extends Controller
{
    /**
     * Register new user
     *
     * @param $request Request
     */    public function register(Request $request)
    {
        $this->validate($request, [
            
            'email'=> 'required|string|max:255|email',
            'password'=>'required'
        ]);

        $credentials = $request()->only('email','password');


        
       

       
      
        $user=User::first();
        //$token=JWTAuth::formUser($user);
        //return Response::json( compact('token'));
        return 'Thanks for register !  ';
    }

       //update_Delivery_request_admin
       public function updateReqestDel(Request $request , $id){

        $Reqests_Delivery= Reqests_Delivery::find($id);
        $this->validate($request, [
            'user_id',
            'delivery_id',
            'dish_id',
            'Quantity',
            'status'
        ]);
        $user_id =$request->input('user_id');
        $delivery_id =$request->input('delivery_id');
        $dish_id =$request->input('dish_i d');
        $Quantity =$request->input('Quantity');
        $Category =$request->input('Category');
        if($user_id!=null ){
        $Reqests_Delivery->user_id =$user_id;
       }
       if($delivery_id!=null){
          $Reqests_Delivery->delivery_id =$delivery_id;
       }
       if($prix !=null){
        $Reqests_Delivery->prix  =$prix ;
       }
       if($Quantity!=null){
        $Reqests_Delivery->Quantity =$Quantity;
     }
     if($Category !=null){
      $Reqests_Delivery->Category  =$Category ;
     }
       $Reqests_Delivery->save();
       return 'Reqests_Delivery updated !';
    }
}
       
