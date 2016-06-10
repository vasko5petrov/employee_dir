@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Employee details</h5>
                    <div>
                        <div class="row">
                            <div class="col s12">
                                <div class="col s4" align="center">
                                    <img alt="Employee picture" src="{{url('/').'/'.$em->picture}}" class="circle responsive-imge" style="width: 80%;">
                                </div>
                                <div class=" col s8">
                                    <table class="responsive-table">
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
        </div>
    </div>
</div>
@endsection