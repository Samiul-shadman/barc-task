<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Helper\JWTToken;
use Exception;
use Illuminate\Http\Request;
use App\Models\AttendedExams;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;

class ExamController extends Controller
{
    public function ExamPage($exam_id){
        $question = Exam::where('id', '=', $exam_id)
        ->first();
        //  return $question;
        return view('pages.exam.exam-questions', compact('question'));
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
            $exams = Exam::first();
            
        }
        else{
            $ch = 'not empty';
            $exams = Exam::leftjoin('attended_exams', function(JoinClause $join) use ($user_id){
                $join->on('exams.id', '=', 'attended_exams.exam_id')
                    ->where('attended_exams.user_id' ,'=', $user_id);
            })
            ->whereNull('attended_exams.user_id')
            ->first();
        }
  
            return response()->json([
                'Exams' => $exams
            ]);


            // return response()->json([
            //     '$user' => $user,
            //     'attended?' => $attended_exams,
            //     'check' => $ch,
            //     'Exams' => $exams

            // ]);
    }


    public function ExamIdCheck(Request $request){
        try{
        $question = Exam::where('id', '=', $request->input('exam_id'))
                    ->get();

        return response()->json([
            'status' => 'success',
            'question' => $question
        ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'No Exam Avaiable'
            ]);
        }
    }

    // public function ExamQuestion(Request $request,$exam_id){
    // try{
    //     $question = Exam::where('id', '=', $exam_id)
    //                 ->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'question' => $question
    //     ]);
    //     }
    //     catch(Exception $e){
    //         return response()->json([
    //             'status' => 'No Exam Avaiable'
    //         ]);
    //     }
    // }


    public function AnsStore(Request $request,$exam_id){
        $user_id = $request->header('id');

        $request->merge([
            'user_id' => $user_id,
            'exam_id' => $exam_id
        ]);
        $exam_data = $request->input();

        AttendedExams::create($request->input());

        return redirect('/exam-list');
    }
}
