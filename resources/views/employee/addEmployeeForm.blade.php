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
                        {!! Form::open(array('route' => 'auth.employee.add', 'class' => 'form-horizontal','files' => true, 'method' => 'post')) !!}
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div align="center">
                                        <img alt="Employee picture" src="{{url('/uploads/images/icon-user-default.png')}}" class="img-circle img-responsive">
                                    </div>
                                    <hr>
                                    {!! Form::file('image', null) !!}
                                    @if($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('image')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group{{$errors->has('em-name') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="em-name" value="{{old('em-name')}}" autofocus>
                                        @if($errors->has('em-name'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-name')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{$errors->has('em-job-title') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Job title</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="em-job-title" value="{{old('em-job-title')}}">
                                        @if($errors->has('em-job-title'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('em-job-title')}}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{$errors->has('em-email') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label">Email</label>

                                    <div class="col-md-6">
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

                                    <div class="col-md-6">
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

                                    <div class="col-md-6">
                                        <select class="form-control" name="em-department-id" >
                                            <option hidden>Select one</option>
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
                                        <button type="submit" class="btn btn-primary">
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