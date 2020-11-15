<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php 
        $route = \Route::current()->uri;
    @endphp
    <meta charset="utf-8">
    <link rel="icon" href="{{ url('public/images/logo.png') }}" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Online Exam</title>

   
    <link rel="stylesheet" href="{{ asset('public')}}/fontawesome-free/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('public/images/logo.png') }}" type="image/png" height="27" width="27"> Online Exam
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item">
                                <a @if($route == 'exam-papers') class="nav-link active" @else class="nav-link" @endif   href="{{ url('exam-papers') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Exam Papers
                                </a>
                            </li>
                            @can('Admin')
                            <li class="nav-item">
                                <a @if($route == 'questions') class="nav-link active" @else class="nav-link" @endif   href="{{ url('questions') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Questions
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a @if($route == 'subjects') class="nav-link active" @else class="nav-link" @endif   href="{{ url('subjects') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Subjects
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ getIdentity() }})
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('error.msg')
            @yield('content')
        </main>
    </div>
    <div class="modal fade" id="mediumModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="mediumModalTitle">Medium Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="mediumModalBody">
              
            </div>
            <div class="modal-footer justify-content-between" id="mediumModalFooter">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>



<script type="text/javascript">
    function addPage(route,name){
        var modal=$('#mediumModal');
        var modalTitle=$('#mediumModalTitle');
        var modalBody=$('#mediumModalBody');
        var modalFooter=$('#mediumModalFooter');
        modal.modal('toggle');
        modalFooter.hide();
        $.ajax({
            url: "{{url('/')}}/"+route+'/create',
            type: 'GET',
            data: {},
        })
        .done(function(response) {
            modalTitle.html('Add '+name);
            modalBody.html(response);
        })
        .fail(function() {
            modal.modal('toggle');
        });
    }

    function editPage(route,id, name){
        var modal=$('#mediumModal');
        var modalTitle=$('#mediumModalTitle');
        var modalBody=$('#mediumModalBody');
        var modalFooter=$('#mediumModalFooter');
        modal.modal('toggle');
        modalFooter.hide();
        $.ajax({
            url: "{{url('/')}}/"+route+'/'+id+"/edit",
            type: 'GET',
            data: {},
        })
        .done(function(response) {
            modalTitle.html('Edit '+name);
            modalBody.html(response);
        })
        .fail(function() {
            modal.modal('toggle');
        });
    }
  
</script>


<script type="text/javascript">
    function Delete(route,id) {
    $.confirm({
        title: 'Confirm!',
        content: '<hr><strong class="text-danger">Are you sure to delete ?</strong><hr>',
        buttons: {
            confirm: function () {
                $.ajax({
                  headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                  url: "{{url('/')}}/"+route+'/'+id,
                  type: 'DELETE',
                  dataType: 'json',
                  data: {},
                  success:function(response) {
                    if(response.success){
                      $('#tr-'+id).fadeOut();
                    }else{
                      $.alert({
                        title:"Whoops!",
                        content:"<hr><strong class='text-danger'>Something Went Wrong!</strong><hr>",
                        type:"red"
                      });
                    }
                  }
                });
            },
            cancel: function () {

            }
        }
    });   
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- <script src="{{ url('public/js/app.js') }}"></script> --}}
</body>
 <!-- Scripts -->



</html>
