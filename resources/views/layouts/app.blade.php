<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Employee Directory</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" rel='stylesheet' type='text/css'>--}}
    <link href="{{url('/font-awesome/css/font-awesome.min.css')}}" rel='stylesheet' type='text/css'>
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel='stylesheet' type='text/css'>--}}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    {{--<link href="{{url('/css/bootstrap-flatly.min.css')}}" rel="stylesheet" type="text/css">--}}
    <link href="{{url('/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/materialize/css/materialize.min.css') }}" type="text/css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">--}}

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav>
        <div class="nav-wrapper light-green darken-2">
            <a class="brand-logo" href="{{ url('/') }}">
                <!-- Branding Image -->
                {{--<img src="{{URL::asset('logo.png')}}" width="24" style="vertical-align: middle; display: inline-block;">--}}
                {{--<div style="vertical-align: middle; display: inline-block;">Employee Directory</div>--}}
                Employee Directory
            </a>
            <a href="#" data-activates="nav-mobile" class="button-collapse">
                <i class="material-icons">menu</i>
            </a>

            <!-- Left Side Of Navbar -->
            <ul class="right hide-on-med-and-down">
                <li><a href="{{url('/department')}}">Departments</a></li>
                <li><a href="{{url('/employee')}}">Employees</a></li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li>
                        <a href="#" class="dropdown-button"  data-activates="menu-dropdown">
                            <span style="width: 50px;">{{ Auth::user()->username }}<i class="material-icons right">arrow_drop_down</i></span>
                        </a>
                        <ul id="menu-dropdown" class="dropdown-content">
                            <li><a href="{{url('/update/password')}}"><i class="tiny material-icons left" style="font-size: 18px;">mode_edit</i>Edit password</a></li>
                            @if(Auth::user()->email == 'example@gmail.com')
                                <li><a href="{{ url('/invite') }}"><i class="tiny material-icons left" style="font-size: 18px;">email</i>Invite admin</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="tiny material-icons left" style="font-size: 18px;">chevron_left</i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            {{--Mobile menu--}}
            <ul id="nav-mobile" class="side-nav">
                <li><a href="{{url('/department')}}">Departments</a></li>
                <li><a href="{{url('/employee')}}">Employees</a></li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li>
                        <a href="#" class="dropdown-button"  data-activates="mobile-menu-dropdown">
                            <span style="width: 50px;">{{ Auth::user()->username }}<i class="material-icons right">arrow_drop_down</i></span>
                        </a>
                    </li>
                    <ul id="mobile-menu-dropdown" class="dropdown-content">
                        <li><a href="{{url('/update/password')}}"><i class="tiny material-icons left" style="font-size: 18px;">mode_edit</i>Edit password</a></li>
                        @if(Auth::user()->email == 'example@gmail.com')
                            <li><a href="{{ url('/invite') }}"><i class="tiny material-icons left" style="font-size: 18px;">email</i>Invite admin</a></li>
                        @endif
                        <li><a href="{{ url('/logout') }}"><i class="tiny material-icons left" style="font-size: 18px;">chevron_left</i>Logout</a></li>
                    </ul>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/materialize/js/materialize.js')}}"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script>--}}
    {{--<script src="{{url('/js/bootstrap.min.js')}}"></script>--}}
    
    <script type="text/javascript">
        $(document).ready(function () {
            $(".button-collapse").sideNav();
            $(".dropdown-button").dropdown();
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
            });
        });
    </script>

    @yield('script')
</body>
</html>
