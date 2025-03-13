<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
   
    public function login(Request $request){

       
        $credentials=$request->all(['email','password']);

        $validado=Validator::make($credentials, [
            'email'=> 'required', 'string', 'email',
            'password'=> 'required', 'string'
            ]
        )->validate();



        
        if (! $token = auth('api')->attempt($credentials)) {
            $message = new ApiMessages("Inauthorized");
            return response()->json($message->getMessage(),401) ;
        }

        return response()->json([
            'token' => $token
        ]);
    }


    public function logout(){
        auth('api')->logout();

        return response()->json(["message"=>"Logout successfuly"],200);
    }

    public function refresh(){
        $token= auth('api')->refresh();

        return response()->json([
            'token' => $token
        ]);
    }
}
