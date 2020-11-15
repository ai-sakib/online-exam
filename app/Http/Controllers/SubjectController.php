<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Question;
use App\Models\ExamPaper;
use App\Models\Set;

class SubjectController extends Controller
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
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request, Subject $subject)
    {
        $this->validate($request,[
            'name' => 'required | unique:subjects',
        ]);

        $subject->fill($request->all())->save();
        session()->flash('success', 'Subject successfully created');
        return back();
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subject.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required | unique:subjects',
        ]);

        $subject = Subject::find($id);

        $subject->fill($request->all())->save();
        session()->flash('success', 'Subject successfully updated');
        return back();
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        $delete = $subject->delete();
        if($delete){
            // $questions = Question::where('subject_id',$subject->id)->delete();
            // $exam_papers = ExamPaper::where('subject_id',$subject->id)->get();
            // $exam_papers_delete = ExamPaper::where('subject_id',$subject->id)->delete();
            // foreach ($exam_papers as $key => $value) {
            //     Set::where('exam_paper_id',$value->id)->delete();
            // }
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
