<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequset;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthenticationController extends Controller
{
    public function register(SignUpRequest $request)
    {
       $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
       ]);
        $token = $user->createToken('token created');
       return $token;
    }
    public function login(LoginRequset $request)
    {
        if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password]))
        {
            $user= $request->user();
            $token=$user->createToken($user->name.'-AuthToken')->plainTextToken;
            return response(['access token'=>$token],200);
        }
        return response(['message'=> 'email or password wrong!'],401);

    }


    public function user()
    {
        $user=Auth::user();
        return response(['data'=>$user],200);
    }      

    public function logout()
    {
        request()->user()->tokens()->delete();
        return response(['message'=>'successful logout'],200);
    }
}
