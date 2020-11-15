<div class="container">
    
    @if(Session::has('success'))
    <div style="padding: -10px 0px -10px 0px" class="alert alert-success">
    	<a style="cursor: pointer;" class="close" data-dismiss="alert">×</a>{!!Session::get('success')!!}
    </div>
    @endif

    @if(Session::has('error'))
    <div style="padding: -10px 0px -10px 0px" class="alert alert-danger">
        <a style="cursor: pointer;" class="close" data-dismiss="alert">×</a>{!!Session::get('error')!!}
    </div>
    @endif

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div style="padding: -10px 0px -10px 0px" class="alert alert-danger">
                <a style="cursor: pointer;" class="close" data-dismiss="alert">×</a>{!! $error !!} <br/>
            </div>
        @endforeach
    @endif
</div>