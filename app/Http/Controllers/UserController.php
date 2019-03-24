<?php
namespace App\Http\Controllers;

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
            'firstname'=> 'required',
            'lastname'=> 'required',
            'email'=> 'required|string|max:255|email|unique:users',
            'phonenumber'=>'required|unique:users',
            'password'=>'required'
        ]);

        $email = $request->input('email');
        $firstname =$request->input('firstname');
        $lastname = $request->input('lastname');
        $phonenumber =$request->input('phonenumber');
       


        $user = User::create([
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenumber' => $phonenumber,
            'password' => $request->input('password'),
        ]);

       
      
        $user=User::first();
        //$token=JWTAuth::formUser($user);
        //return Response::json( compact('token'));
        return 'Thanks for register !  ';
    }
}
       
