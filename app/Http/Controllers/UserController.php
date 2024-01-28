<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\AttendedExams;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Exception;


class UserController extends Controller
{

    function loginPage(){
        return view('pages.auth.login-page');
    }

    function registrationPage(){
        return view('pages.auth.registration-page');
    }

    function ExamList(){
        return view('pages.exam.exampage-show');
    }

    
    public function UserRegistration(Request $request){
        
        try{
            User::UpdateorCreate($request->input());

            return response()->json([
                'status' =>  'success',
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
            ->first();

        if($count != null){
            $token = JWTToken::CreateToken($request->input('email'),$count->id);
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

    public function UserLogout(){
        return redirect('/')->cookie('token', '', -1);
    }


    

}
