@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" rel="stylesheet">

	<div class="container">
	    <div class="card">
	    	<div class="card-header">
		    	<h4 class="card-title">
		    		Questions
		    		<a onclick="addPage('questions', 'Question')" style="float: right" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add New Question</a>
		    	</h4>
		    	
	    	</div>
	    	<div class="card-body p-2">
    			<div class="row">
	    			<div class="col-md-4">
	    				<form id="form" method="get" action="{{ url('questions') }}">
		    				<div class="form-group">
						      <select onchange="getQuestion()" class="form-control" name="subject_id" class="subject_id" id="subject_id">
						      	<option value="0">Select Subject</option>
						      	@foreach($subjects as $subject)
						      		<option value="{{ $subject->id }}" @if($subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
						      	@endforeach
						      </select>
						    </div>
	    				</form>
	    			</div>
	    			<div class="col-md-4">
	    				<input class="form-control" type="text" id="myInput" placeholder="Search ..." onkeyup="searchQuestion()">
	    			</div>
	    			<div  class="col-md-4">
	    				<a style="float: right;background-color: #17a2b8;color: white" class="btn-block btn btn-primary" onclick="createExamPaper()"><i class="fas fa-paperclip"></i> Create Exam Paper</a>
	    			</div>
	    		</div>
	    		
	    		<form id="create_exam_paper_form" method="post" action="{{ route('exam-papers.store') }}">
	    			@csrf
	    			<input type="hidden" name="subject_id" value="{{ $subject_id }}">
	    			<div class="table-responsive p-0">
	    				
	    			
		    		<table class="table table-bordered" id="myTable">
		    			<thead>
		    				<tr style="background-color:#3ea891; color:white">
		    					<th width="10%" class="text-center">Select</th>
		    					<th width="10%">Q. No</th>
		    					<th width="20%">Subject</th>
		    					<th width="50%">Question</th>
		    					<th width="10%" class="text-center">Action</th>
		    				</tr>
		    			</thead>
	                    <tbody>
	                    	@if(isset($questions[0]->id))
		                        @foreach($questions as $key => $question)
		                            <tr id="tr-{{ $question->id }}">
		                                <td class="text-center"><input style="width: 17px !important; height: 17px !important" type="checkbox" name="selected_question[]" value="{{ $question->id }}"></td>
		                                <td>{{ $question->id }}</td>
		                                <td>{{ $question->subject->name }}</td>
		                                <td>{!! $question->question !!}</td>
		                                <td class="text-center">
		                                    <button type="button" onclick="editPage('questions','{{ $question->id }}','Question')" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		                                    <button type="button" onclick="Delete('questions','{{ $question->id }}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
		                                </td>
		                            </tr>
		                        @endforeach
		                    @else
		                    	<tr>
		                    		<td colspan="5" class="text-center"> Sorry! no data available</td>
		                    	</tr>
		                    @endif
	                    </tbody>
		    		</table>
		    		</div>
	    		</form>
	    	</div>
	    </div>
	</div>
@endsection
<script type="text/javascript">
	function getQuestion(){
		$('#form').submit();
	}
	function createExamPaper(){
		$('#create_exam_paper_form').submit();
	}
	function searchQuestion() {
	  // Declare variables 
	  var input, filter, table, tr, i, j, column_length, count_td, null_tr = 0;
	  column_length = document.getElementById('myTable').rows[0].cells.length;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");
	  for (i = 1; i < tr.length; i++) { // except first(heading) row
	  	count_td = 0;
	  	for(j = 1; j < column_length-1; j++){ // except first column
	  		td = tr[i].getElementsByTagName("td")[j];
			/* ADD columns here that you want you to filter to be used on */
		    if (td) {
		      if ( td.innerHTML.toUpperCase().indexOf(filter) > -1)  {            
		        count_td++;
		      }
		    }
	  	}
	  	console.log(count_td)
	  	if(count_td > 0){
	  		tr[i].style.display = "";
      	} else {
      		null_tr++;
        	tr[i].style.display = "none";
      	}
	  }
	  
	}
</script>

