<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    protected $fillable = [
        'exam_paper_id','set_no','student_id','assigned_by','correct_answers',
    ];

    public function student(){
    	return $this->hasOne('App\User','user_id', 'student_id');
    }

    public function admin(){
    	return $this->hasOne('App\User','user_id', 'assigned_by');
    }
}
