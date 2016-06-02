@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Welcome</h5>
                    <p>
                        Hi there. You're using Employee Directory application.
                        </br>
                        Enjoy!
                        <br>
                        Check out our <a href="https://github.com/trieudh58/employee_dir">repo on Github</a>, or visit demo <a href="http://www.velocityteam.xyz">here</a>
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
