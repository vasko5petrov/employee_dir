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
                    <h5 class="card-title">Edit department</h5>
                    <div>
                        {!! Form::open([
                            'action' => array('DepartmentController@edit', $dp->id),
                            'files' => true,
                            'method' => 'post',
                        ]) !!}
                        <div class="row">
                            {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="text" class="validate{{ $errors->first('dp-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-name') }}" name="dp-name" value="{{ $dp->name }}" id="dp-name" autofocus>
                                    <label for="dp-name">Name</label>
                                    @if ($errors->has('dp-name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('dp-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="text" class="validate{{ $errors->first('dp-office-number') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-office-number') }}" name="dp-office-number" value="{{ $dp->office_number }}" id="dp-office-number">
                                    <label for="dp-office-number">Office number</label>
                                    @if ($errors->has('dp-office-number'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('dp-office-number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <select name="dp-manager-id">
                                        <option value="{{ $dp->manager_id }}" selected>{{ $manager_name }}</option>
                                        @if(sizeof($employees))
                                            @foreach($employees as $em)
                                                <option value="{{$em->id}}">{{$em->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label>Manager</label>
                                    @if ($errors->has('dp-manager-id'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('dp-manager-id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light green">
                                        <i class="material-icons left">save</i>Save
                                    </button>
                                    <a href="{{ url('/department') }}" class="btn waves-effect waves-light red">
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
