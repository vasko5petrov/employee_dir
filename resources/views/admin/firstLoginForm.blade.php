@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12" hidden>
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Change your passowrd</h3>
                </div>
                    
                    <div class="panel-body" style="padding: 50px;">
                        <form method="post" action="{{ url('/login/first') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="new_password">New password</label>
                                    <input type="hidden" name="hashed_id" value="{{$hashed_id}}">
                                    <input type="password" class="form-control validate" data-error="{{ $errors->first('new_password') }}" name="new_password">
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Confirm password</label>
                                    <input type="password" class="form-control validate" data-error="{{ $errors->first('password_confirm') }}" name="password_confirm">
                                    @if ($errors->has('password_confirm'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password_confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                    <a href="{{ url('/logout') }}" class="btn btn-cancel">
                                        <i class="fa fa-times"></i> Cancel
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