<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\MultipleChoice;
//use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $questions = '';
        $subject_id = $request->subject_id;
        if($subject_id > 0){
            $questions = Question::where('subject_id',$subject_id)->get();
        }
        $subjects = Subject::orderBy('name')->get();
        
        return view('question.index', compact('questions','subjects','subject_id'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('question.create',compact('subjects'));
    }

    public function store(Request $request, Question $question)
    {
        $this->validate($request,[
            'subject_id' => 'required',
            'question' => 'required | unique:questions',
            'correct_answer' => 'required',
        ]);

        $question->fill($request->all())->save();

        if($question){
            foreach ($request->answer as $key => $answer) {
                MultipleChoice::create([
                    'question_id' => $question->id,
                    'answer_no' => $key + 1,
                    'answer' => $answer,
                ]);
            }
        }
        session()->flash('success', 'Question successfully created');
        return redirect('questions?subject_id='.$request->subject_id);
    }

    public function edit($id)
    {
        $question = Question::find($id);
        $subjects = Subject::orderBy('name')->get();
        return view('question.edit', compact('question','subjects'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        $this->validate($request,[
            'subject_id' => 'required',
            'question' => 'required | unique:questions,question,'.$id.',id',
            'correct_answer' => 'required',
        ]);
        
        $question->fill($request->all())->save();
        if($question){
            foreach ($request->answer as $key => $answer) {
                MultipleChoice::where(['question_id'=>$question->id,'answer_no'=> $key+1])->update([
                    'answer' => $answer,
                ]);
            }
        }

        session()->flash('success', 'Question successfully updated');
        return back();
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $delete = $question->delete();
        if($delete){
           //MultipleChoice::where('question_id', $question->id)->delete();
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
