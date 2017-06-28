@extends('layouts.app')

@section('content')
<div class="container animated fadeInLeft">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12" hidden>
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>

    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Update Passowrd</h3>
                </div>
                    
                    <div class="panel-body" style="padding: 50px;">
                        <form method="POST" action="{{ url('/update/password') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="current_password">Current password</label>
                                    <input type="password" class="form-control validate{{ $errors->first('current_password') ? ' animated shake' : '' }}" data-error="{{ $errors->first('current_password') }}" name="current_password" value="{{ old('current_password') }}" autofocus>
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New password</label>
                                    <input type="password" class="form-control validate{{ $errors->first('new_password') ? ' animated shake' : '' }}" data-error="{{ $errors->first('new_password') }}" name="new_password" value="{{ old('new_password') }}">
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Confirm password</label>
                                    <input type="password" class="form-control validate{{ $errors->first('password_confirm') ? ' animated shake' : '' }}" data-error="{{ $errors->first('password_confirm') }}" name="password_confirm" value="{{ old('password_confirm') }}">
                                    @if ($errors->has('password_confirm'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password_confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                    <a href="{{url('/')}}" type="button" class="btn btn-danger">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var msg = $('#result');
        if (msg) {
            Materialize.toast(msg, 5000);
        }
    });
</script>
@endsection