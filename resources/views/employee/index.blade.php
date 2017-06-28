@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Employees
        @if(!Auth::guest())
            <a href="{{url('/employee/add')}}" style="float: right;" class="btn btn-lg btn-success" title="Add employee">
                <i class="large material-icons">add</i>
            </a>
        @endif
        </h3>
        <hr>
        <div class="row">
        <div class="col-md-12">
            <a data-toggle="collapse" href="#collapse-search-form" class="btn btn-primary btn-block">Search</h4></a>
            <br>
            <div id="collapse-search-form" class="collapse">
            <form method="GET" url="employee" id="search-form" >
                <input type="hidden" name="search" value=1>
                <div class="form-group">
                    <input type="text" class="form-control" name="em-search-name" placeholder="Employee Name" value="{{$em_search_name}}">
                </div>
                <div class="form-group">
                    <select class="form-control" name="em-search-dp">
                        <option value="">All Departments</option>
                        @foreach($departments as $dp)
                            @if ($dp->id == $em_search_dp)
                                <option value="{{$dp->id}}" selected>{{$dp->name}}</option>
                            @else
                                <option value="{{$dp->id}}">{{$dp->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-search"></i> Search
                </button>
                <button class="btn btn-sm btn-danger" data-toggle="collapse" href="#collapse-search-form" id="close-search-form">
                    <i class="fa fa-close"></i> Close
                </button>
            </form>
            </div>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-12">
        @if(sizeof($employees))
            <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
            <table class="table tablesorter table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        @if(!Auth::guest())
                            <th class="disabled">Actions</th>
                        @endif
                    </tr>
                <tbody id="tbody">
                @foreach($employees as $index=>$em)
                    <tr id="{{'info-'.$em->id}}">
                        <div>
                            <td>{{($employees->currentPage()-1)*15+$index+1}}</td>
                            <td><a href="{{url('/employee').'/'.$em->id.'/detail'}}">{{$em->name}}</a></td>
                            <td>
                                @if($em->department)
                                    <a href="{{url('/department').'/'.$em->department->id.'/detail'}}">{{$em->department->name}}</a>
                                @endif
                            </td>
                            <td>{{$em->job_title}}</td>
                            <td>{{$em->email}}</td>
                            <td>{{$em->phone_number}}</td>
                            @if(!Auth::guest())
                                <td style="width: 100px;">
                                    <div id="{{'action-'.$em->id}}">
                                        <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$em->id}}"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            @endif
                        </div>
                    </tr>
                @endforeach
                </tbody>
                </thead>
            </table> 
            <center>
                {!! $employees->render() !!}
            </center>
        @endif
        </div>
        </div>

    </div>
@endsection
