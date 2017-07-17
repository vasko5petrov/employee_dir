@extends('layouts.app')

@section('content')
<div class="container">
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
                    <h3 style="color: white">Send request</h3>
                </div>
                    
                    <div class="panel-body" style="padding: 50px;">
                        <form method="POST" action="{{ url('/helpdesk') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control validate{{ $errors->first('subject') ? ' animated shake' : '' }}" data-error="{{ $errors->first('subject') }}" name="subject" value="{{ old('subject') }}" autofocus>
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control validate{{ $errors->first('message') ? ' animated shake' : '' }}" data-error="{{ $errors->first('message') }}">{{ old('message') }}</textarea> 
                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-send"></i> Send
                                    </button>
                                    <a href="{{ url('/') }}" class="btn btn-danger">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                        @if(Session::has('warning'))
                            <div class="alert alert-danger">{{ Session::get('warning') }}</div>
                        @elseif(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
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