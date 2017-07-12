@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($flag))
            <div class="col-md-12">
                <input id="flag" value="{{ $flag }}" type="text" disabled hidden>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Add Event</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                                            {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                    {!! Form::open([
                        'action' => 'EventController@add',
                        'files' => true,
                        'method' => 'post'
                    ]) !!}
                        <div class="row">
                            <div class="form-group">
                                <label for="event-name">Name</label>
                                <input type="text" class="form-control validate{{ $errors->first('event-name') ? ' animated shake' : '' }} " data-error="{{ $errors->first('event-name') }}" name="event-name" value="{{ old('event-name') }}" id="event-name" autofocus autocomplete="off">
                                @if ($errors->has('event-name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="event-title">Event Title</label>
                                <input type="text" class="form-control validate{{ $errors->first('event-title') ? ' animated shake' : '' }} " data-error="{{ $errors->first('event-title') }}" name="event-title" value="{{ old('event-title') }}" id="event-title" autocomplete="off">
                                @if ($errors->has('event-title'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="event-dates">Dates</label>
                                <input type="text" class="form-control" name="event-dates" value="{{ old('event-dates') }}" id="event-dates" >
                                @if ($errors->has('event-dates'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-dates') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Create Article
                                </button>
                                <a href="{{ url('/posts') }}" class="btn btn-lg btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
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
            var type = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New event successfully created.';
                    type = 'success';
                }
                else {
                    msg = 'Error. Please try again.';
                    type = 'danger'
                }

                $.bootstrapGrowl(
                    msg,{
                    type: type,
                    delay: 2000,
                });
            }
            $('input[name="event-dates"]').daterangepicker({
				"minDate": moment('<?php echo date('Y-m-d G')?>'),
				"timePicker": true,
				"timePicker24Hour": true,
				"timePickerIncrement": 15,
				"autoApply": true,
				"locale": {
					"format": "DD-MM-YYYY HH:mm:ss",
					"separator": " - ",
				}
			});
        });
    </script>
@endsection
