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
}
       
