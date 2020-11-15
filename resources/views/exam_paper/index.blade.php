@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" rel="stylesheet">

	<div class="container">
	    <div class="card">
	    	<div class="card-header">
		    	<h4 class="card-title">
		    		Exam Papers
		    		@can('Admin')
		    		<a href="{{ url('questions') }}" style="float: right" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Add New Exam Paper</a>
		    		@endcan
		    	</h4>
		    	
	    	</div>
	    	<div class="card-body table-responsible p-2">
    			<div class="row">
	    			<div class="col-md-4">
	    				<form id="form" method="get" action="{{ url('exam-papers') }}">
		    				<div class="form-group">
						      <select onchange="getExamPaper()" class="form-control" name="subject_id" class="subject_id" id="subject_id">
						      	<option value="0">Select Subject</option>
						      	@foreach($subjects as $subject)
						      		<option value="{{ $subject->id }}" @if($subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
						      	@endforeach
						      </select>
						    </div>
	    				</form>
	    			</div>
	    		</div>
	    		<table class="table table-bordered">
	    			<thead>
	    				<tr style="background-color:#3ea891; color:white">
	    					<th width="10%">Paper No</th>
	    					<th width="30%">Subject</th>
	    					<th width="50%" class="text-center">Sets</th>
	    					@can('Admin')
	    					<th width="10%" class="text-center">Action</th>
	    					@endcan
	    				</tr>
	    			</thead>
                    <tbody>
                    	@if(isset($exam_papers[0]->id))
                    	@can('Admin')
                    		@if(isset($exam_papers[0]->id))
		                        @foreach($exam_papers as $key => $paper)
		                            <tr id="tr-{{ $paper->id }}">
		                                <td>{{ $paper->id }}</td>
		                                <td>{{ $paper->subject->name }}</td>
		                                <td class="text-center">
		                                	@for($i = 1; $i <= 4; $i++)
		                                		<a class="btn btn-info btn-sm" href="{{ url('exam-papers') }}/{{ $paper->id }}&{{ $i }}">Set {{ $i }}</a>
		                                	@endfor
		                                </td>
		                                <td class="text-center">
		                                    <button type="button" onclick="Delete('exam-papers','{{ $paper->id }}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
		                                </td>
		                            </tr>
		                        @endforeach
		                    @else
		                    	<tr>
		                    		<td colspan="4" class="text-center">Sorry ! No Data Available</td>
		                    	</tr>
		                    @endif
	                    @endcan
                    	@can('Students')
	                        @foreach($exam_papers as $key => $paper)
			                    @php 
		                			$assigned_exam_paper = App\Models\AssignStudent::where([
		                				'exam_paper_id'=>$paper->id,
		                				'student_id'=>Auth::id(),
		                			])->first();
		                		@endphp
		                		@if(isset($assigned_exam_paper->id))
		                            <tr id="tr-{{ $paper->id }}">
		                                <td>{{ $paper->id }}</td>
		                                <td>{{ $paper->subject->name }}</td>
		                                <td class="text-center">
		                                	@for($i = 1; $i <= 4; $i++)
		                                		@php 
		                                			$set = App\Models\AssignStudent::where([
		                                				'exam_paper_id'=>$paper->id,
		                                				'set_no'=>$i,
		                                				'student_id'=>Auth::id(),
		                                			])->first();
		                                		@endphp
		                                		@if(isset($set->id))
		                                			<a class="btn btn-info btn-sm" href="{{ url('exam-papers') }}/{{ $paper->id }}&{{ $set->set_no }}">Set {{ $set->set_no }}</a>
		                                		@endif
		                                	@endfor
		                                </td>
		                            </tr>
		                         @endif
	                        @endforeach
	                    @endcan

	                    @else
	                    	<tr>
	                    		<td colspan="5" class="text-center"> Sorry! no data available</td>
	                    	</tr>
	                    @endif
                    </tbody>
	    		</table>
	    	</div>
	    </div>
	</div>
@endsection
<script type="text/javascript">
	function getExamPaper(){
		$('#form').submit();
	}
</script>

