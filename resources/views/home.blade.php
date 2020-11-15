@extends('layouts.app')

@section('content')
<div class="container">
    <div style="padding:50px" class="row justify-content-center">
        <h2>Welcome <strong style="color: #39b398">{{ explode(' ', Auth::user()->name)[0] }}</strong>, to the best online exam platform, <strong style="color: #39b398">Online Exam</strong></h2>
        
    </div>
    <center>
        <div>
            <hr>
            @can('Admin')
            <a href="{{ url('questions') }}" class="btn btn-primary">Create Exam Paper</a> la la
            @endcan
        </div>
    </center>
</div>
@endsection
