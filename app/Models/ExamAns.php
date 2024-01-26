<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAns extends Model
{
    use HasFactory;

    function Exam(){
        return $this->belongsTo(Exam::class);
    }
}
