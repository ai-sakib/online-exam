@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" rel="stylesheet">

	<div class="container">
	    <div class="card">
	    	<div class="card-header">
		    	<h4 class="card-title">
		    		Subjects
		    		@can('Admin')
		    		<a onclick="addPage('subjects', 'Subject')" style="float: right" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add New Subject</a>
		    		@endcan
		    	</h4>
		    	
	    	</div>
	    	<div class="card-body table-responsible p-2">
	    		<table class="table table-bordered">
	    			<thead>
	    				<tr style="background-color: #3ea891;color: white">
	    					<th>SL</th>
	    					<th>Name</th>
	    					<th class="text-center">Exam Papers</th>
	    					@can('Admin')
	    					<th class="text-center">Action</th>
	    					@endcan
	    				</tr>
	    			</thead>
                    <tbody>
                    	@if(isset($subjects[0]->id))
	                        @foreach($subjects as $key => $subject)
	                            <tr id="tr-{{ $subject->id }}">
	                                <td>{{ $key + 1 }}</td>
	                                <td>{{ $subject->name }}</td>
	                                <td class="text-center">
	                                    <a class="btn btn-sm btn-info" href="{{ url('exam-papers?subject_id=') }}{{ $subject->id }}">See Exam Papers</a>
	                                </td>
	                                @can('Admin')
	                                <td class="text-center">
	                                    <button onclick="editPage('subjects','{{ $subject->id }}','Subject')" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
	                                    <button onclick="Delete('subjects','{{ $subject->id }}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
	                                </td>
	                                @endcan
	                            </tr>
	                        @endforeach
	                    @else
	                    	<tr>
	                    		@can('Admin')
	                    			<td colspan="4" class="text-center">Sorry ! No Data Available</td>
	                    		@else
	                    			<td colspan="4" class="text-center">Sorry ! No Data Available</td>
	                    		@endcan
	                    	</tr>
	                    @endif

                    </tbody>
	    		</table>
	    	</div>
	    </div>
	</div>
	
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

