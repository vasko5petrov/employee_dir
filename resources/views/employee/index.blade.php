@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Employees</div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                            </tr>
                            <tbody>
                            @foreach($employees as $index=>$em)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td><a href="{{url('/employee').'/'.$em->id.'/detail'}}">{{$em->name}}</a></td>
                                    <td><a href="{{url('/department').'/'.$em->department->id.'/detail'}}">{{$em->department->name}}</a></td>
                                    <td>{{$em->job_title}}</td>
                                    <td>{{$em->email}}</td>
                                    <td>{{$em->phone_number}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection