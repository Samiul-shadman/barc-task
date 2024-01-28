<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Helper\JWTToken;
use App\Models\ExamAns;
use Exception;
use Illuminate\Http\Request;
use App\Models\AttendedExams;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;

class ExamController extends Controller
{

    private $examId ;
    private $userId ;

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
            $exams = Exam::first();
            
        }
        else{
            $exams = Exam::leftjoin('attended_exams', function(JoinClause $join) use ($user_id){
                $join->on('exams.id', '=', 'attended_exams.exam_id')
                    ->where('attended_exams.user_id' ,'=', $user_id);
            })
            ->whereNull('attended_exams.user_id')
            ->select('exams.id','exams.Exam_name')
            ->first();
        }
  
            return response()->json([
                'Exams' => $exams
            ]);
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



    public function AnsStore(Request $request,$exam_id){
        $user_id = $request->header('id');

        $this->userId = $user_id;
        $this->examId = $exam_id;

        session(['userId' => $this->userId, 'examId' => $this->examId]);

        $request->merge([
            'user_id' => $user_id,
            'exam_id' => $exam_id
        ]);

        AttendedExams::create($request->input());

        return redirect('/exam-result');
    }


    public function ExamResult(){
        $userId = session('userId');
        $examId = session('examId');

        $exam_data = AttendedExams::where('user_id', '=', $userId)
        ->where('exam_id', '=', $examId)
        ->first();

        $exam_name = Exam::where('id', '=', $examId)
        ->first();

        $exam_ans = ExamAns::where('exam_id', '=', $examId)
        ->first();

        $result = 0;

        for ($i = 1; $i <= 5; $i++) {
            $exam_data_property = "Exam_ans_$i";
            $exam_ans_property = "Ans_$i";
        
            if ($exam_data->$exam_data_property == $exam_ans->$exam_ans_property) {
                $result++;
            }
        }


        return view('pages.exam.examresult-show', [
            'exam_name' => $exam_name,
            'result' => $result
        ]);
    }
}   
