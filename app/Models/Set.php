<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = [
        'exam_paper_id','set_no','question_id','answer_id'
    ];

    public function exam_paper(){
    	return $this->belongsTo(ExamPaper::class);
    }

    public function assigned_student(){
    	return $this->belongsTo(ExamPaper::class);
    }
}
