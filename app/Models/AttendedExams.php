<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendedExams extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'Exam_ans_1',
        'Exam_ans_2',
        'Exam_ans_3',
        'Exam_ans_4',
        'Exam_ans_5'
    ];
    
    function Exams(){
        return $this->belongsTo(Exam::class);
    }
}
