<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendedExams extends Model
{
    use HasFactory;

    function Exams(){
        return $this->belongsTo(Exam::class);
    }
}
