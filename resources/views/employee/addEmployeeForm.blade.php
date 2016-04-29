@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($errors) == 0 && isset($flag))
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>New employee successfully added!</strong>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add employee</div>
                    <div class="panel-body">
                        {!! Form::open([
                            'action' => 'EmployeeController@add',
                            'class' => 'form-horizontal',
                            'files' => true,
                            'method' => 'post',
                        ]) !!}
                            <link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >
                            <div class="col-sm-4">
                                <div align="center">
                                    <img alt="Employee picture" src="{{url('/uploads/images/icon-user-default.png')}}" class="avatar img-responsive" id="avatar">
                                </div>
                                <hr>
                                {!! Form::file('image', ['id'=>'picture']) !!}
                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group{{$errors->has('em-name') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Name</label>

                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="em-name" id="em-name" value="{{old('em-name')}}" autofocus>
                                        @if($errors->has('em-name'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-name')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{$errors->has('em-job-title') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Job title</label>

                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="em-job-title" id="em-job-title" value="{{old('em-job-title')}}">
                                        @if($errors->has('em-job-title'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-job-title')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{$errors->has('em-email') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Email</label>

                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="em-email" value="{{old('em-email')}}">
                                        @if($errors->has('em-email'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-email')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{$errors->has('em-phone-number') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Phone number</label>

                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="em-phone-number" value="{{old('em-phone-number')}}">
                                        @if($errors->has('em-phone-number'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-phone-number')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{$errors->has('em-department-id') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Department</label>

                                    <div class="col-md-8">
                                        <select class="form-control" name="em-department-id" >
                                            <option></option>
                                            @if(sizeof($departments))
                                                @foreach($departments as $dp)
                                                    <option value="{{$dp->id}}">{{$dp->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('em-department-id'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-department-id')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" id="em_button">
                                            <i class="fa fa-btn fa-floppy-o"></i>Save
                                        </button>
                                        <a type="button" class="btn btn-default" href="{{url('/employee')}}">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection