<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    function attendedExams(){
        return $this->hasMany(AttendedExams::class);
    }

    function examAns(){
        return $this->hasOne(ExamAns::class);
    }
}
