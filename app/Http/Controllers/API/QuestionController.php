<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\MultipleChoice;
//use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    
    public function getQuestions($subject_id)
    {   
        return $questions = Question::with('subject')->where('subject_id',$subject_id)->get();
        
    }

    
}
