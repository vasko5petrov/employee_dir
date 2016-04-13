@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Departments
                        @if(!Auth::guest())
                            <div class="pull-right">
                                <a href="{{url('/department/add')}}" class="btn btn-primary btn-xs">
                                    <i class="fa fa-btn fa-plus" aria-hidden="true"></i>Add
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Office Number</th>
                                    <th>Manager</th>
                                    @if(!Auth::guest())
                                        <th></th>
                                    @endif
                                </tr>
                            <tbody>
                                @foreach($departments as $index=>$dp)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td><a href="{{url('/department').'/'.$dp->id}}">{{$dp->name}}</a></td>
                                        <td>{{$dp->office_number}}</td>
                                        <td>
                                            @if($dp->manager())
                                                <a href="{{url('/employee').'/'.$dp->manager()->id}}">{{$dp->manager()->name}}</a>
                                            @endif
                                        </td>
                                        @if(!Auth::guest())
                                            <td>
                                                <a href="{{url('/department').'/edit/'.$dp->id}}" class="btn btn-primary btn-xs">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{url('/department').'/delete/'.$dp->id}}" class="btn btn-danger btn-xs">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        @endif
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