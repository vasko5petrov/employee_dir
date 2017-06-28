@extends('layouts.app')

@section('content')
<div class="container animated fadeInLeft">
    <div class="row">
        @if(isset($flag))
            <div class="col s12 m8 offset-m2">
                <input id="flag" value="{{ $flag }}" type="text" disabled hidden>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Invite new Administrator</h3>
                </div>
                    
                    <div class="panel-body" style="padding: 50px;">
                        <form method="POST" action="{{ url('/invite/send-invitation') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="admin-username">Username</label>
                                    <input type="text" class="form-control validate{{ $errors->first('admin-username') ? ' animated shake' : '' }}" data-error="{{ $errors->first('admin-username') }}" name="admin-username" value="{{ old('admin-username') }}" autofocus>
                                    @if ($errors->has('admin-username'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('admin-username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="admin-email">Email</label>
                                    <input type="email" class="form-control validate{{ $errors->first('admin-email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('admin-email') }}" name="admin-email" value="{{ old('admin-email') }}">
                                    @if ($errors->has('admin-email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('admin-email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="submit">
                                        <i class="fa fa-send"></i> Send
                                    </button>
                                    <a href="{{ url('/') }}" class="btn btn-danger">
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
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var flag = $('#flag').val();
        var msg = '';
        if (flag) {
            if (flag == 1) {
                msg = 'Email sent.';
            }
            else {
                msg = 'Error. Please try again.';
            }
            Materialize.toast(msg, 5000);
        }
    });
</script>
@endsection