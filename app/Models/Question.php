<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'subject_id','question','correct_answer',
    ];

    public function subject(){
    	return $this->belongsTo(Subject::class);
    }

    // public function answer(){
    // 	return $this->belongsTo(MultipleChoice::class, 'correct_answer','id');
    // }

    public function answers(){
    	return $this->hasMany(MultipleChoice::class, 'question_id','id');
    }
}
