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
                    <h5 class="card-title">Add department</h5>
                    <div>
                        <form method="POST" action="{{ url('/department/add') }}">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="input-field col s12">
                                    <input type="text" class="validate{{ $errors->first('dp-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-name') }}" name="dp-name" value="{{ old('dp-name') }}" id="dp-name" autofocus>
                                    <label for="dp-name">Name</label>
                                    @if ($errors->has('dp-name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('dp-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <input type="text" class="validate{{ $errors->first('dp-office-number') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-office-number') }}" name="dp-office-number" value="{{ old('dp-office-number') }}" id="dp-office-number">
                                    <label for="dp-office-number">Office number</label>
                                    @if ($errors->has('dp-office-number'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('dp-office-number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    <select name="dp-manager-id">
                                        <option value="" disabled selected>Choose one</option>
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
                                    <button class="btn waves-effect waves-light">
                                        <i class="material-icons left">save</i>Save
                                    </button>
                                    <a href="{{ url('/department') }}" class="btn waves-effect waves-light">
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
    <script type="text/javascript" src="{{URL::asset('js/dp_validation.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();

            var flag = $('#flag').val();
            var msg = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New department successfully added.';
                }
                else {
                    msg = 'Error. Please try again.';
                }
                Materialize.toast(msg, 5000);
            }
        });
    </script>
@endsection