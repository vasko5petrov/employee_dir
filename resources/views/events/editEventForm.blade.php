@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12">
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Edit Event</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                                            {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                    {!! Form::open([
                        'action' => array('EventController@edit', $event->id),
                        'files' => true,
                        'method' => 'post',
                    ]) !!}
                        <div class="row">
                            <div class="form-group">
                                <label for="event-title">Event Title</label>
                                <input type="text" class="form-control validate{{ $errors->first('event-title') ? ' animated shake' : '' }}" data-error="{{ $errors->first('event-title') }}" name="event-title" value="{{ $event->title }}" id="event-title" autocomplete="off">
                                @if ($errors->has('event-title'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('event-title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="event-body">Event Description</label>
                                <textarea name="event-body" id="event-body" class="form-control validate{{ $errors->first('event-body') ? ' animated shake' : ''}}" data-error="{{ $errors->first('event-body') }}">{{$event->description}}</textarea>
                                @if ($errors->has('event-body'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="event-dates">Dates</label>
                                <input type="text" class="form-control validate{{ $errors->first('event-dates') ? ' animated shake' : '' }}" data-error="{{ $errors->first('event-dates') }}" name="event-dates" value="{{ $event->start_time . ' - ' . $event->end_time }}" id="event-dates" >
                                @if ($errors->has('event-dates'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-dates') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="event-color">Choose Color</label>
                                <datalist id="pallete">
                                  <option>#2196f3</option>
                                  <option>#e51c23</option>
                                  <option>#4caf50</option>
                                  <option>#9c27b0</option>
                                  <option>#ff9800</option>
                                </datalist>
                                <input type="color" class="form-control validate{{ $errors->first('event-color') ? ' animated shake' : ''}}" data-error="event-color" name="event-color" list="pallete" value="{{ $event->color }}" id="event-color">
                                @if ($errors->has('event-color'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event-color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Save Article
                                </button>
                                <a href="{{ url('/events/'.$event->id) }}" class="btn btn-lg btn-danger">
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

            var msg = $('#result');
            if(msg.length >= 1) {
                $.bootstrapGrowl(
                    msg,{
                    type: 'success',
                    delay: 2000,
                });
            }
            $('input[name="event-dates"]').daterangepicker({
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