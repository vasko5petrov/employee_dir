@extends('layouts.app')

@section('content')
<div class="container animated fadeInUp">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Welcome</h5>
                    <p>
                        This is the Anakatech Team office data website. <br>
                        View employees and departments. <br>
                        Check your own employee profile.
                    </p>
                </div>
                <div class="card-action">
                    <a href="{{ url('/department') }}">Departments</a>
                    <a href="{{ url('/employee') }}">Employees</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
