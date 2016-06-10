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
                    <h5 class="card-title"><strong>Change password on first login</strong></h5>
                    <div>
                        <form method="post" action="{{ url('/login/first') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="hidden" name="hashed_id" value="{{$hashed_id}}">
                                    <input type="password" class="validate" data-error="{{ $errors->first('new_password') }}" name="new_password">
                                    <label for="new_password">New password</label>
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" class="validate" data-error="{{ $errors->first('password_confirm') }}" name="password_confirm">
                                    <label for="password_confirm">Confirm password</label>
                                    @if ($errors->has('password_confirm'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password_confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light" type="submit">
                                        <i class="material-icons left">save</i>Save
                                    </button>
                                    <a href="{{ url('/logout') }}" class="btn waves-effect waves-light">
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