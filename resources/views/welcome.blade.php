@extends('layouts.app')

@section('content')
<div class="container animated fadeInUp">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome</h1>
                <p>
                    This is the {{ config('app.name', 'Anakatech Family') }} office data website. <br>
                            View employees and departments. <br>
                            Check your own employee profile.
                </p>
                <a href="{{ url('/department') }}"><button type="button" class="btn btn-lg btn-default">Departments</button></a>
                <a href="{{ url('/employee') }}"><button type="button" class="btn btn-lg btn-primary">Employees</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
