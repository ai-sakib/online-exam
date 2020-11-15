<form method="post" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data" >
	@method('PUT')
    @csrf
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
		      <label for="subject_id">Subject</label><span style="color:red"> *</span>
		      <select class="form-control" name="subject_id" class="subject_id" id="subject_id">
		      	@foreach($subjects as $subject)
		      		<option value="{{ $subject->id }}" @if($question->subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
		      	@endforeach
		      </select>
		      
		    </div>
		    <div class="form-group">
		      <label for="question">Question</label><span style="color:red"> *</span>
		      <textarea class="form-control" required id="question" name="question">{{ old('question',$question->question) }}</textarea>
		    </div>

		    <div class="form-group">
		      <label for="question">Answers</label><span style="color:red"> *</span>
		      <div class="row">
		      	@foreach($question->answers as $key => $option)
		      	<div class="col-md-1">
		      		{{ options()[$key+1] }}) <br>
		      	</div>
		      	<div class="col-md-11">
		      		<input type="text" class="form-control" value="{{ $option->answer }}" required name="answer[]"><br>
		      	</div>
		      	@endforeach
		      </div>
		      
		    </div>
		    <div class="form-group">
		      <label for="correct_answer">Correct Answer</label><span style="color:red"> *</span>
		      <select required name="correct_answer" class="form-control" id="correct_answer">
		      	<option value=""> --- Select --- </option>
		      	@foreach(options() as $key => $option)
		      		<option value="{{ $key }}" @if($question->correct_answer == $key) selected @endif>{{ $option }}</option>
		      	@endforeach
		      </select>
		    </div>
		    <div class="modal-footer justify-content-between" id="quickViewModalFooter">
		      <button type="submit" class="btn btn-primary">Update</button>
		      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		</div>
	</div>
</form>