@extends('layouts.app')

@section('content')
<div class="container animated fadeInLeft">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Login</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                        <form method="post" action="{{ url('/login') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control validate{{ $errors->first('email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('email') }}" name="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control validate{{ $errors->first('password') ? ' animated shake' : '' }}" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember" id="remember" class="filled-in">
                                    <label for="remember">Remember me</label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success form-control " type="submit" name="submit">Login</button>
                                </div>
                            </div>
                        </form>
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
