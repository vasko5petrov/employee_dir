<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>{{ config('app.name', 'Anakatech Team') }}</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" rel='stylesheet' type='text/css'>--}}
    <link href="{{url('/font-awesome/css/font-awesome.min.css')}}" rel='stylesheet' type='text/css'>
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel='stylesheet' type='text/css'>--}}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    {{--<link href="{{url('/css/bootstrap-flatly.min.css')}}" rel="stylesheet" type="text/css">--}}
    <link href="{{url('/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/bootstrap-datepicker.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/custom.css') }}" type="text/css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9Yah75rDjdUSwHjPt420XKmH1RLiSMA4&libraries=places&sensor=false&language=en"></script>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">--}}

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
        table caption {
            background-color: #777;
            color: white;
        }
        .employeeDetails table th {
            width: 160px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
          <div class="container-flex">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{URL::asset('website-logo.png')}}" width="150" class="website_logo"/>
              </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="{{url('/department')}}">Departments</a></li>
                <li><a href="{{url('/employee')}}">Employees</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="width: 50px;">{{ Auth::user()->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-header">Admin Actions</li>
                          <li><a href="{{url('/department/add')}}"><i class="fa fa-plus"></i> Add Department</a></li>
                          <li><a href="{{url('/employee/add')}}"><i class="fa fa-plus"></i> Add Employee</a></li>
                          <li class="divider" role="separator"></li>
                          <li><a href="{{url('/update/password')}}"><i class="fa fa-edit"></i> Edit Password</a></li>
                          <li><a href="{{url('/invite')}}"><i class="fa fa-edit"></i> Invite admin</a></li>
                          <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>

                        </ul>
                    </li>
                @endif
              </ul>
            </div><!--/.nav-collapse -->
          </div>
    </nav>
    <div class="content-wrap">
        @yield('content')
    </div>
    <!-- JavaScripts -->
    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/js/bootstrap-notify.js')}}"></script>
    <script src="{{url('/js/googleAutocomplete.js')}}"></script>
    <script src="{{url('/js/jquery.tablesorter.js')}}"></script>
    <script src="{{url('/js/custom.js')}}"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script>--}}
    {{--<script src="{{url('/js/bootstrap.min.js')}}"></script>--}}

    <script type="text/javascript">
        $(document).ready(function () {
            /*$(".button-collapse").sideNav();
            $(".dropdown-button").dropdown();
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
            });
            $(".sortable").tablesorter();

            $('.modal-trigger').leanModal();
            $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
                $('#deleteForm').submit();
            });
            $('.datepicker.birthday').pickadate({
                selectMonths: true,
                selectYears: 50,
                format: 'yyyy-mm-dd',
                max: " "
            });
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 50, // Creates a dropdown of 15 years to control year
                format: 'yyyy-mm-dd'
            });*/

            $(".sortable").tablesorter();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });

            $(".tablesorter").tablesorter();
        });
    </script>

    @yield('script')
</body>
</html>
