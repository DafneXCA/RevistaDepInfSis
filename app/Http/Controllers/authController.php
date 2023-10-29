<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class authController extends Controller
{
    public function login(Request $request){
      
        if(Auth::attempt(request()->only('user','password'))){
            $user=Auth::user();
            $token=$user->createToken('auth_token')->plainTextToken;

            return response()->json(['token'=>$token,'user'=>$user],200);
        }

        return response()->json(request()) ;
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'logout'],200);
    }
}
