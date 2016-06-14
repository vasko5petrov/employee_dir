@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col s12 m8 offset-m2" hidden>
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Update password</h5>
                    <div>
                        <form method="POST" action="{{ url('/update/password') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="password" class="validate{{ $errors->first('current_password') ? ' animated shake' : '' }}" data-error="{{ $errors->first('current_password') }}" name="current_password" value="{{ old('current_password') }}" autofocus>
                                    <label for="current_password">Current password</label>
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" class="validate{{ $errors->first('new_password') ? ' animated shake' : '' }}" data-error="{{ $errors->first('new_password') }}" name="new_password" value="{{ old('new_password') }}">
                                    <label for="new_password">New password</label>
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" class="validate{{ $errors->first('password_confirm') ? ' animated shake' : '' }}" data-error="{{ $errors->first('password_confirm') }}" name="password_confirm" value="{{ old('password_confirm') }}">
                                    <label for="password_confirm">Confirm password</label>
                                    @if ($errors->has('password_confirm'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password_confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light" type="submit" name="submit">
                                        <i class="material-icons left">save</i>Save
                                    </button>
                                    <a href="{{url('/')}}" type="button" class="btn waves-effect waves-light">
                                        <i class="material-icons left">cancel</i>Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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