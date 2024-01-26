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

    function LoginPage(){
        return view('pages.auth.login-page');
    }

    function RegistrationPage(){
        return view('pages.auth.registration-page');
    }

    function ExamPage(){
        return view('pages.dashboard.profile-page');
    }

    
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
            ->first();

            //return $count;



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


    public function UserExams(Request $request){

        $user = [
            'email' => $request->header('email'),
            'id' => $request->header('id')
        ];

        $user_id = $user['id'];

        $attended_exams = AttendedExams::where('user_id', '=', $user['id'])->get();
        
        if($attended_exams->isempty()){
            $ch = 'empty';
            $exams = Exam::get();
            
        }
        else{
            $ch = 'not empty';
            $exams = Exam::leftjoin('attended_exams', function(JoinClause $join) use ($user_id){
                $join->on('exams.id', '=', 'attended_exams.exam_id')
                    ->where('attended_exams.user_id' ,'=', $user_id);
            })
            ->whereNull('attended_exams.user_id')
            ->get();
        }

            return response()->json([
                '$user' => $user,
                'attended?' => $attended_exams,
                'check' => $ch,
                'Exams' => $exams

            ]);
    }

}
