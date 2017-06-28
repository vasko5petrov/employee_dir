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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Add employee</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                                            {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                        {!! Form::open([
                            'action' => 'EmployeeController@add',
                            'files' => true,
                            'method' => 'post'
                        ]) !!}
                        <div class="row">
                            <div class="form-group">
                                <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Choose image {!! Form::file('image', ['id'=>'picture', 'class'=>'form-control-file', 'style'=>'display:none;' ]) !!}
                                </span>
                                </label>
                                <input type="file" style="display: none;" multiple/>
                                <input type="text" class="form-control" style="padding-left: 10px;" readonly/>

                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-name">Name</label>
                                <input type="text" class="form-control validate{{ $errors->first('em-name') ? ' animated shake' : '' }} " data-error="{{ $errors->first('em-name') }}" name="em-name" value="{{ old('em-name') }}" id="em-name" autofocus>
                                @if ($errors->has('em-name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-department-id">Gender</label>
                                <select name="em-gender" class="form-control">
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @if($errors->has('em-gender'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('em-gender')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-birthday">Birthday</label>
                                <input type="text" class="form-control datepicker birthday" name="em-birthday" value="{{ old('em-birthday') }}" id="em-birthday" autofocus>
                                @if ($errors->has('em-birthday'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-location">Location</label>
                                <input type="text" class="form-control validate{{ $errors->first('em-location') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-location') }}" name="em-location" value="{{ old('em-location') }}" id="em-location" placeholder="">
                                @if ($errors->has('em-location'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-job-title">Job title</label>
                                <input type="text" class="form-control validate{{ $errors->first('em-job-title') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-job-title') }}" name="em-job-title" value="{{ old('em-job-title') }}" id="em-job-title">
                                @if ($errors->has('em-job-title'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-job-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-email">Email</label>
                                <input type="email" class="form-control validate{{ $errors->first('em-email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-email') }}" name="em-email" value="{{ old('em-email') }}" id="em-email">
                                @if ($errors->has('em-email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-phone-number">Phone number</label>
                                <input type="text" class="form-control validate{{ $errors->first('em-phone-number') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-phone-number') }}" name="em-phone-number" value="{{ old('em-phone-number') }}" id="em-phone-number">
                                @if ($errors->has('em-phone-number'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-phone-number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-department-id">Department</label>
                                <select name="em-department-id" class="form-control">
                                    <option value=""></option>
                                    @if(sizeof($departments))
                                        @foreach($departments as $dp)
                                            <option value="{{$dp->id}}">{{$dp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('em-department-id'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('em-department-id')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="em-hiringDate">Hiring Date</label>
                                <input type="text" class="datepicker form-control" name="em-hiringDate" value="{{ old('em-hiringDate') }}" id="em-hiringDate" autofocus>
                                @if ($errors->has('em-hiringDate'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-hiringDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <a href="{{ url('/employee') }}" class="btn btn-lg btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        {!! Form::close() !!}
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
            var type = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New employee successfully added.';
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
        });
    </script>
@endsection