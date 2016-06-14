@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title"><strong>Login</strong></h5>
                    <div>
                        <form method="post" action="{{ url('/login') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="email" class="validate{{ $errors->first('email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('email') }}" name="email">
                                    <label for="email">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" class="validate{{ $errors->first('password') ? ' animated shake' : '' }}" name="password">
                                    <label for="password">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="checkbox" name="remember" id="remember" class="filled-in">
                                    <label for="remember">Remember me</label>
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light" type="submit" name="submit">Login</button>
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
        Materialize.updateTextFields();
    })
</script>
@endsection
