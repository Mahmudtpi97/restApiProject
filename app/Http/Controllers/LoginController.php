<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use App\Models\registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validate($request,[
            'username' =>'required',
            'password' =>'required',
        ]);
       $username = $request->input('username');
       $password = $request->input('password');

       $userCount = registration::where(['username'=> $username , 'password'=> $password])->count();
        if ($userCount == 1) {

            $key = env('Access_Token'); //access_key generate by .env
            $payload = [
                'site' => 'http://mahmudtpi97.github.io/Portfolio',
                'user' => $username,
                'iat' => time(),
                'exp' => time()+3000
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            return response()->json(['access_token'=>$jwt, 'Status'=>'Login Success']);
        }
        else{
            return "Wrong Username or Password !";
        }
    }
}
