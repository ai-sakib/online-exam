@extends('layouts.app')

@section('content')
	<div class="container">
		@can('Admin')
		<form method="post" action="{{ url('assign-student') }}">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<input type="hidden" name="exam_paper_id" value="{{ $set->exam_paper_id }}">
					<input type="hidden" name="set_no" value="{{ $set->set_no }}">
    				<div class="form-group">
						<select required class="form-control" name="student_id">
	    					<option value=""> --- Assign Student --- </option>
	    					@foreach ($students as $student)
	    						<option value="{{ $student->id }}">{{ $student->name }}</option>
	    					@endforeach
	    				</select>
					</div>
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn-block btn btn-info">Assign</button>
				</div>
			</div>
		</form>
		@endcan
		<form method="post" action="{{ route('submit-answers') }}">
			@csrf
			<input type="hidden" name="exam_paper_id" value="{{ $set->exam_paper_id }}">
			<input type="hidden" name="set_no" value="{{ $set->set_no }}">
		    <div class="card">
		    	<div class="card-header">
			    	<h4>Exam Paper - {{ $set->exam_paper_id }} ({{ $set->exam_paper->subject->name }})<span style="float: right">Set - {{ $set->set_no }}</span></h4>
			    	
			    	
		    	</div>
		    	@php 
	    			$submitted = 0;
	    			if(Auth::user()->role->role_id == 2){
	    				$check = App\Models\AssignStudent::where(['exam_paper_id'=>$set->exam_paper_id,'student_id'=>Auth::id()])->first();
	    				if($check->correct_answers != null){
	    					$submitted = 1;
	    					$given_answers = json_decode($check->correct_answers, true);
	    					$total = count($given_answers);
	    					$no_of_correct_answers = 0;
	    					foreach ($given_answers as $question_id_for_answer => $given_answer) {
	    						$question_for_answer = App\Models\Question::find($question_id_for_answer);
	    						if(isset($question_for_answer->id)){
	    							if($question_for_answer->correct_answer == $given_answer){
	    								$no_of_correct_answers++;
	    							}
	    						}
	    					}
	    				}
	    			}
	    		@endphp
	    		@if($submitted == 1)
	    			<button style="margin: 50px" type="button" class="btn btn-info">You've got ({{ $no_of_correct_answers }}/{{ $total }})</button>
	    		@else
		    		<div class="card-body table-responsible p-2">
		    		
						@php 
			    			$questions_array = json_decode($set->question_id, true);
			    			$answers_array = json_decode($set->answer_id, true);
			    			$key = 0;
			    		@endphp
			    		@foreach($questions_array as $questionKey => $question_id)
			    			@php 
				    			$question = App\Models\Question::find($question_id);
				    			if(isset($question->id)){
				    				$key++;
				    			}else{
				    				continue;
				    			}
				    		@endphp
				    		<div class="row">
					    		<div class="col-md-6">
					    			<h6>Q. {{ $key }}) {!! $question->question !!}</h6>
				    			
				    				@for($answerKey = 0; $answerKey < 5; $answerKey++)
					    				@php 
							    			$answer = App\Models\MultipleChoice::where(['question_id'=>$question_id,'answer_no'=>$answers_array[$questionKey][$answerKey]])->first();
							    		@endphp
				    					{{ options()[$answerKey+1] }}) {{ $answer->answer }}<br>
				    				@endfor
						    	</div>
						    	@can('Students')
				    			<div class="col-md-3">
					    			<div class="form-group">
										<label for="answer[{{ $question_id }}]">Choose Correct Answer<span style="color:red"> *</span></label>
										<select required class="form-control" name="answer[{{ $question_id }}]">
					    					<option value=""> --- Select --- </option>
					    					@for($choice = 1; $choice <= 5; $choice++)
					    						<option value="{{ $choice }}">{{ options()[$choice] }}.</option>
					    					@endfor
					    				</select>
									</div>
						    	</div>
						    	@endcan
					    	</div>
							
		    				<hr>

			    		@endforeach
			    	</div>
			    	@can('Students')
				    	<div class="card-footer">
				    		<button type="submit" class=" btn-block btn btn-info">Submit Answer</button>
				    	</div>
				    @endcan
		    	@endif
		    </div>
		</form>
	</div>
@endsection
<script type="text/javascript">

</script>

