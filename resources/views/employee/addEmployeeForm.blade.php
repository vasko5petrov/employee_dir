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
                    <h5 class="card-title">Add employee</h5>
                    <div>
                        {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                        {!! Form::open([
                            'action' => 'EmployeeController@add',
                            'files' => true,
                            'method' => 'post',
                        ]) !!}
                        <div class="row">
                            <div class=" file-field input-field col s12">
                                <div align="center" class="col s12">
                                    <img alt="Employee picture" src="{{url('/uploads/images/icon-user-default.png')}}" style="width: 40%;" class="circle responsive-img" id="avatar">
                                </div>
                                <div class="col s12">
                                    <div class="btn col s4">
                                        <span>Choose file</span>
                                        {!! Form::file('image', ['id'=>'picture']) !!}
                                    </div>
                                    <div class="file-path-wrapper col s8">
                                        <input class="file-path validate" type="text">
                                    </div>
                                    @if($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('image')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate" data-error="{{ $errors->first('em-name') }}" name="em-name" value="{{ old('em-name') }}" id="em-name" autofocus>
                                <label for="em-name">Name</label>
                                @if ($errors->has('em-name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate" data-error="{{ $errors->first('em-job-title') }}" name="em-job-title" value="{{ old('em-job-title') }}" id="em-job-title">
                                <label for="em-job-title">Job title</label>
                                @if ($errors->has('em-job-title'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-job-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="email" class="validate" data-error="{{ $errors->first('em-email') }}" name="em-email" value="{{ old('em-email') }}" id="em-email">
                                <label for="em-email">Email</label>
                                @if ($errors->has('em-email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('em-email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="validate" data-error="{{ $errors->first('em-phone-number') }}" name="em-phone-number" value="{{ old('em-phone-number') }}" id="em-phone-number">
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
                                    @if(sizeof($departments))
                                        @foreach($departments as $dp)
                                            <option value="{{$dp->id}}">{{$dp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="em-department-id">Department</label>
                                @if($errors->has('em-department-id'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('em-department-id')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light" type="submit">
                                    <i class="material-icons left">save</i>Save
                                </button>
                                <a href="{{ url('/employee') }}" class="btn waves-effect waves-light">
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
            $('select').material_select();

            var flag = $('#flag').val();
            var msg = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New employee successfully added.';
                }
                else {
                    msg = 'Error. Please try again.';
                }
                Materialize.toast(msg, 5000);
            }
        });
    </script>
@endsection