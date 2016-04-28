@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Employee details</span>
                        <div class="pull-right">
                            <a href="{{URL::previous()}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-btn fa-chevron-left" aria-hidden="true"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <link href="{{URL::asset('css/table_details.css')}}" rel="stylesheet" >
                        <link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >
                        <br>
                        <div class="col-md-4" align="center">
                            <img alt="Employee picture" src="{{url('/').'/'.$em->picture}}" class="avatar img-responsive">
                        </div>
                        <div class=" col-md-8"> 
                            <table class="table table-details">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$em->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>{{$em->department_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Title</th>
                                        <td>{{$em->job_title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{$em->phone_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$em->email}}</td>
                                    </tr>
                                </tbody>
                            </table >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection