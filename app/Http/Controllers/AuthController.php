<?php





namespace App\Http\Controllers;
use App\User;

use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }


    public function register(Request $request)
    {

        $this->validate($request, [
           'name'=> 'required',
           'email'=> 'required|email|max:255|unique:users',
           'deliverer',
           'password' => 'required'
     ]);
     $table = User::create([
        'name' =>  $request->input('name'),
        'email' =>$request->input('email'),
        'deliverer' =>$request->input('deliverer'),
         'password' =>Hash::make($request->input('password'))

    ]);
     return 'thanks for register:D !';

     //  return $name;
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }



    public function test()
    {

       // $token = $this->jwt->getToken();
      //  $this->jwt->user();
       // $data = $this->jwt->setToken($token)->toUser();
       // print_r($data);
        echo "hi now you are in :p ";

    }



    
}
       
