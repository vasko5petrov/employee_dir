@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($errors) == 0 && isset($result) && isset($alert_type))
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-{{$alert_type}} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{$result}}</strong>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Employee</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/employee').'/'.$em->id.'/edit'}}">
                            {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('em-name') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="em-name" value="{{$em->name}}" autofocus>
                                    <input type="hidden" class="form-control" name="em-id" value="{{$em->id}}">
                                    @if($errors->has('em-name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('em-name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{$errors->has('em-department-id')? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Department</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="em-department-id" >
                                        @foreach($departments as $dp)
                                            @if ($dp->id == $em->department_id)
                                                <option value="{{$dp->id}}" selected>{{$dp->name}}</option>
                                            @else
                                                <option value="{{$dp->id}}">{{$dp->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($errors->has('em-department-id'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('em-department-id')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('em-job-title') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Job Title</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="em-job-title" value="{{$em->job_title}}">
                                    @if($errors->has('em-job-title'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('em-job-title')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{$errors->has('em-phone-number') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Phone Number</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="em-phone-number" value="{{$em->phone_number}}">
                                    @if($errors->has('em-phone-number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('em-phone-number')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{$errors->has('em-email') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="em-email" value="{{$em->email}}">
                                    @if($errors->has('em-email'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('em-email')}}</strong>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection