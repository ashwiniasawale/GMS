<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function __construct()
    {
     
    }
    public function register(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            "email"=>"required|string|email|unique:users",
            "password"=>"required"
        ]);
       
       $data= [
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password)
        ];
        $user=User::create_user($data);

        return response()->json([
            "status"=>true,
            "message"=>"User Register Successfully",
            "data"=>[]
        ]);

    }

    public function login(Request $request)
    {
        $request->validate([
            "email"=>"required|string|email",
            "password"=>"required"
        ]);

        $user=User::where("email",$request->email)->first();
        if(!empty($user))
        {
            if(Hash::check($request->password,$user->password))
            {
                $token=$user->createToken("mytoken")->plainTextToken;

                return response()->json([
                    "status"=>true,
                    "message"=>"User Logined in",
                    "token"=>$token,
                    "data"=>[]
                ]);
            }else{
                return response()->json([
                    "status"=>false,
                    "message"=>"Invalid Password",
                    "data"=>[]
                ]);
            }
        }else{
            return response()->json([
                "status"=>false,
                "message"=>"Please pass email and password",
                "data"=>[]
            ]);
        }
    }

    public function profile()
    {
        $userData=auth()->user();
        $get_data=User::get_profile();
        return response()->json([
            "status"=>true,
            "message"=>"Profile Information",
            "data"=>$get_data
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "status"=>true,
            "message"=>"User Logged Out",
            "data"=>[]
        ]);
    }
    
}