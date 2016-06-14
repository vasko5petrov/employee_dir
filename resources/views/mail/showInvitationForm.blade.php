@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($flag))
            <div class="col s12 m8 offset-m2">
                <input id="flag" value="{{ $flag }}" type="text" disabled hidden>
            </div>
        @endif
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Invite new administrator</h5>
                    <div>
                        <form method="POST" action="{{ url('/invite/send-invitation') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="text" class="validate{{ $errors->first('admin-username') ? ' animated shake' : '' }}" data-error="{{ $errors->first('admin-username') }}" name="admin-username" value="{{ old('admin-username') }}" autofocus>
                                    <label for="admin-username">Username</label>
                                    @if ($errors->has('admin-username'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('admin-username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="email" class="validate{{ $errors->first('admin-email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('admin-email') }}" name="admin-email" value="{{ old('admin-email') }}">
                                    <label for="admin-email">Email</label>
                                    @if ($errors->has('admin-email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('admin-email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect waves-light" name="submit">
                                        <i class="material-icons left">send</i>Send
                                    </button>
                                    <a href="{{ url('/') }}" class="btn waves-effect waves-light">
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