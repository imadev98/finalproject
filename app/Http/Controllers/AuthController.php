<?php





namespace App\Http\Controllers;
use App\User;
use App\Role;
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
           'password' => 'required'
     ]);
     $table = User::create([
        'name' =>  $request->input('name'),
        'email' =>$request->input('email'),
        'password' =>Hash::make($request->input('password'))

    ]);
    $table->save();
    $name=$table->name;
     return "Thank you for registering in our site!'$name' ";

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

/*
 *----------------------------------------------------------------------------------------------
 *----------------------------------------------------------------------------------------------
 */

public function AddRole(Request $request)
{
    $this->validate($request, [
        'name'=>'required',
        'description'=>'required'
    ]);
    $role = Role::where('name','=',$request->input('name'));
    if($role==null){
        return 'that role Exist !';
    }
    $Role = Role::create([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
    ]);
    return 'Well Role Added  !  ';
}

 public function ShowRoles(){  
    $allRoles=Role::select('name','description')->get();
    return $allRoles;
        }

public function ShowRole($id){  
            $Role=Role::find($id);
            return $Role;
         }

public function updateRole(Request $request , $id)
{
    $Role= Role::find($id);
    $this->validate($request, [
        'name',
        'description'
    ]);
    $name =$request->input('name');
    $description=$request->input('description');
    if($name!=null ){
    $Role->name =$name;
   }
   if($description !=null){
    $Role->description  =$description ;
   }

   $Role->save();
   return 'Role updated !';
 
}

/*
 *----------------------------------------------------------------------------------------------
 *----------------------------------------------------------------------------------------------
 */

public function ShowUsers(){  
    $allUsers=User::all();
    return $allUsers;
        }

public function ShowUser($id){  
            $User=User::find($id);
            return $User;
         }

public function updateUser(Request $request , $id)
{
    $User= User::find($id);
    $this->validate($request, [
        'name',
        'email',
        'password'
    ]);
    $name =$request->input('name');
    $email=$request->input('email');
    $password=$request->input('password');
    if($name!=null ){
    $User->name =$name;
   }
   if($email!=null){
    $User->email =$description ;
   }
   if($password!=null){
    $User->password =Hash::make($password);
   }

   $User->save();
   return 'User updated !';
 
}


//update role user 
public function updateUserRole(Request $request , $id)
{
    $User= User::find($id);
    $this->validate($request, [
        'name_Role',
    ]);

    if($request->input('name_Role')!=null ){
    $name_Role =Role::where('name','=',$request->input('name_Role'))->first();
    $User->role_id =$name_Role->id;
    }
   $User->save();
   return 'Role updated !';
 
}

    
}
       
