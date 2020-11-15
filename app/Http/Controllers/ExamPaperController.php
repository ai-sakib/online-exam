<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Models\Subject;
use App\Models\ExamPaper;
use App\Models\Set;
use App\Models\Question;
use App\Models\AssignStudent;




class ExamPaperController extends Controller
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

    public function index(Request $request){
        //using for 2 actions
        $exam_papers = '';
        $subject_id = $request->subject_id;
        if($subject_id > 0){
            $exam_papers = ExamPaper::where('subject_id',$subject_id)->latest()->get();
        }
        $subjects = Subject::orderBy('name')->get();
        return view('exam_paper.index', compact('subjects','exam_papers','subject_id'));
    }

    public function show($data){
        //show individual set
        $exam_paper_id = explode('&', $data)[0];
        $set_no = explode('&', $data)[1];

        //auth checking
        if(Auth::user()->role->role_id == 2){
            $assigned_exam_paper = AssignStudent::where([
                'exam_paper_id'=>$exam_paper_id,
                'set_no'=>$set_no,
                'student_id'=>Auth::id(),
            ])->first();
            if(!isset($assigned_exam_paper->id)){
                session()->flash('error','Sorry, you are not allowed on this set or exam paper.');
                return redirect('exam-papers');
            }
        }

        $students = User::whereHas('role', function($query){
                        $query->where('role_id', 2);
                    })->get();
        $set = Set::where(['exam_paper_id' => $exam_paper_id, 'set_no' => $set_no])->first();

        return view('exam_paper.set', compact('set','students'));
    }

    public function assignStudent(Request $request){
        //check if already this student was priviously assigned or not
        $matched = AssignStudent::where(['exam_paper_id'=>$request->exam_paper_id,'student_id'=>$request->student_id])->first();
        if(isset($matched->id)){
            session()->flash('error','Selected student already assigned by this exam paper.');
            return back();
        }
        AssignStudent::create([
            'exam_paper_id' => $request->exam_paper_id,
            'set_no' => $request->set_no,
            'student_id' => $request->student_id,
            'assigned_by' => Auth::id(),
        ]);

        session()->flash('success','Successfully assigned the exam paper');
        return back();
    }

    public function submitAnswers(Request $request){
        $assign_student = AssignStudent::where([
            'exam_paper_id' => $request->exam_paper_id,
            'set_no' => $request->set_no,
            'student_id' =>Auth::id()
        ])->first();
        $assign_student->update(['correct_answers'=>json_encode($request->answer)]);

        //Sending Mail
        $to_user = User::find($assign_student->assigned_by);
        if (filter_var($to_user->email, FILTER_VALIDATE_EMAIL)) {
            $subject='Exam Paper Submission';
            $data['subject']=$subject;
            $data['exam_paper_id']=$request->exam_paper_id;
            $data['set_no'] = $request->set_no;
            $data['from_user'] = User::find($assign_student->student_id);
            $data['to_user'] =  $to_user;
            $data['answers'] = $request->answer;

            $sendmail=sendExamPaperMail('emails.exam_paper',$data);
        }

        session()->flash('success','Answers Submitted and Mail Sent To The Admin');
        return back();
    }


    public function store(Request $request)
    {
        if(!isset($request->selected_question)){
            session()->flash('error', 'Please select at least one question !');
            return back();
        }
        $questions_array = array();
        $answers_array = array();
        
        foreach ($request->selected_question as $key => $value) {
            array_push($questions_array, $value);
        }

        $exam_paper = ExamPaper::create([
            'subject_id' => $request->subject_id,
        ]);

        for($i = 1; $i <= 4;  $i++){
            //shuffle question id's
            shuffle($questions_array);

            foreach ($request->selected_question as $key => $value) {
                //shuffle answer id's for each question id
                $range = range(1,5);
                shuffle($range);
                $answers_array[$key] = $range;
            }
            shuffle($answers_array);
            Set::create([
                'exam_paper_id' =>$exam_paper->id,
                'set_no' => $i,
                'question_id' => json_encode($questions_array),
                'answer_id' => json_encode($answers_array),
            ]);
        }
        session()->flash('success','Exam Paper successfully created with 4 sets');
        return redirect('exam-papers?subject_id='.$request->subject_id);
    }


    public function destroy($id)
    {
        $exam_paper = ExamPaper::find($id);
        $delete = $exam_paper->delete();
        if($delete){
            //Set::where('exam_paper_id', $exam_paper->id)->delete();
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
