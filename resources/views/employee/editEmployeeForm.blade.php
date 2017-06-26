@extends('layouts.app')

@section('content')
<div class="container animated fadeInLeft">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col s12 m8 offset-m2" hidden>
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Edit employee</h5>
                    <div>
                        {!! Form::open([
                            'action' => array('EmployeeController@edit', $em->id),
                            'files' => true,
                            'method' => 'post',
                        ]) !!}
                        <div class="row">
                            <div class=" file-field input-field col s12">
                                <div align="center" class="col s12">
                                    <img alt="Employee picture" src="{{url('/').'/'.$em->picture}}" style="width: 40%;" class="circle responsive-img" id="avatar">
                                </div>
                                <div class="col s12">
                                    <div class="btn orange col s4">
                                        <span>Choose file</span>
                                        {!! Form::file('image', ['id'=>'picture']) !!}
                                    </div>
                                    <div class="file-path-wrapper col s8">
                                        <input class="file-path validate" type="text">
                                    </div>
                                    @if($errors->has('image'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('image')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <input type="hidden" name="em-id" value="{{$em->id}}">
                                <input type="text" class="validate{{ $errors->first('em-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-name') }}" name="em-name" value="{{ $em->name }}" id="em-name" autofocus>
                                <label for="em-name">Name</label>
                                @if ($errors->has('em-name'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('em-name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <select name="em-gender">
                                    <option value="{{ $em->gender }}" selected>{{ $em->gender }}</option>
                                    @if ($em->gender == "")
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    @elseif ($em->gender == "Male")
                                        <option value="Female">Female</option>
                                    @elseif ($em->gender = "Female")
                                        <option value="Male">Male</option>
                                    @endif
                                </select>
                                <label for="em-gender">Gender</label>
                                @if($errors->has('em-gender'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{$errors->first('em-gender')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="date" class="datepicker birthday" name="em-birthday" value="{{ $em->birthday }}" id="em-birthday" autofocus>
                                <label for="em-birthday">Birthday</label>
                                @if ($errors->has('em-birthday'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate{{ $errors->first('em-location') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-location') }}" name="em-location" value="{{ $em->location }}" id="em-location" placeholder="">
                                <label for="em-location">Location</label>
                                @if ($errors->has('em-location'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('em-location') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate{{ $errors->first('em-job-title') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-job-title') }}" name="em-job-title" value="{{ $em->job_title }}" id="em-job-title">
                                <label for="em-job-title">Job title</label>
                                @if ($errors->has('em-job-title'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('em-job-title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="email" class="validate{{ $errors->first('em-email') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-email') }}" name="em-email" value="{{ $em->email }}" id="em-email">
                                <label for="em-email">Email</label>
                                @if ($errors->has('em-email'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('em-email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate{{ $errors->first('em-phone-number') ? ' animated shake' : '' }}" data-error="{{ $errors->first('em-phone-number') }}" name="em-phone-number" value="{{ $em->phone_number }}" id="em-phone-number">
                                <label for="em-phone-number">Phone number</label>
                                @if ($errors->has('em-phone-number'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('em-phone-number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <select name="em-department-id" >
                                    <option value=""></option>
                                    @foreach($departments as $dp)
                                        @if ($dp->id == $em->department_id)
                                            <option value="{{$dp->id}}" selected>{{$dp->name}}</option>
                                        @else
                                            <option value="{{$dp->id}}">{{$dp->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="em-department-id">Department</label>
                                @if($errors->has('em-department-id'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{$errors->first('em-department-id')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="date" class="datepicker" name="em-hiringDate" value="{{ $em->hiring_day }}" id="em-hiringDate" autofocus>
                                <label for="em-hiringDate">Hiring Date</label>
                                @if ($errors->has('em-hiringDate'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-hiringDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light green" type="submit">
                                    <i class="material-icons left">save</i>Save
                                </button>
                                <a href="{{ url('/employee') }}" class="btn waves-effect waves-light red">
                                    <i class="material-icons left">cancel</i>Cancel
                                </a>
                            </div>
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
            Materialize.updateTextFields();
            $('select').material_select();

            var msg = $('#result');
            if (msg) {
                Materialize.toast(msg, 5000);
            }
        });
    </script>
@endsection