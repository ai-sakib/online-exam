<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
    protected $fillable = [
        'subject_id',
    ];

    public function subject(){
    	return $this->belongsTo(Subject::class);
    }

    public function sets(){
    	return $this->hasMany(Set::class,'exam_paper_id','id');
    }
}
