@extends('layouts.app')

@section('content')
    <div class="container animated zoomIn">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Department details</span>
                        <div class="pull-right">
                            <a href="{{URL::previous()}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-btn fa-chevron-left" aria-hidden="true"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <link href="{{URL::asset('css/table_details.css')}}" rel="stylesheet" ><br>
                        <table class="table table-details">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$dp->name}}</td>
                                </tr>
                                <tr>
                                    <th>Office number</th>
                                    <td>{{$dp->office_number}}</td>
                                </tr>
                                <tr>
                                    <th>Manager</th>
                                    <td>{{$dp->manager_name}}</td>
                                </tr>
                                <tr>
                                    <th>Number of employees</th>
                                    <td>{{$number_employees}}</td>
                                </tr>
                            </tbody>
                        </table >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection