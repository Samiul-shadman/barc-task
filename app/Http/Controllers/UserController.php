<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    
    public function UserRegistration(Request $request){
        
        try{
            User::UpdateorCreate($request->input());

            return response()->json([
                'message' => 'User created '
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'message' => 'Failed',
                'error' => $e->getMessage()
            ]);
        }
        
    }

    public function UserLogin(Request $request){
        $count = User::where('email','=', $request->input('email'))
            -> where ('password', '=', $request->input('password'))
            ->count();

        if($count == 1){
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'Log in Successfull',
                'token' => $token
            ])->cookie('token',$token,time()+60*24*30);
        }

        else {
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'Log in Failed'
            ]);
        }
    }
}
