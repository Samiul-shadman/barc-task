<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attended_exams', function (Blueprint $table) {
            $table->after('exam_id', function ($table){
                $table->string('Exam_ans_1',500);
                $table->string('Exam_ans_2',500);
                $table->string('Exam_ans_3',500);
                $table->string('Exam_ans_4',500);
                $table->string('Exam_ans_5',500);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attended_exams', function (Blueprint $table) {
            
        });
    }
};
