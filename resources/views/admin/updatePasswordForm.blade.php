@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($result) && isset($alert_type))
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
                    <div class="panel-heading">
                        Update password
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update/password') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('current_password') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Current password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control{{$errors->first('current_password') ? ' animated shake' : ''}}" name="current_password" value="{{old('current_password')}}">
                                    @if($errors->has('current_password'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('current_password')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('new_password') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">New password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control{{$errors->first('new_password') ? ' animated shake' : ''}}" name="new_password">
                                    @if($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('new_password')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('password_confirm') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Confirm new password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control{{$errors->first('password_confirm') ? ' animated shake' : ''}}" name="password_confirm">
                                    @if($errors->has('password_confirm'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('password_confirm')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-floppy-o"></i>Save
                                    </button>
                                    <a href="{{url('/')}}" type="button" class="btn btn-default">
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