<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>{{ config('app.name', 'Anakatech Family') }}</title>

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
    @include('inc.nav')
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
            
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('.ckeditor').ckeditor({
            language: 'en'
        });
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>

    @yield('script')
</body>
</html>
