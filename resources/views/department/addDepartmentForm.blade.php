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
                    <h3 style="color: white">Add Department</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                    <form method="POST" action="{{ url('/department/add') }}">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="dp-name">Name</label>
                                <input type="text" class="form-control validate{{ $errors->first('dp-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-name') }}" name="dp-name" value="{{ old('dp-name') }}" id="dp-name" autofocus>
                                @if ($errors->has('dp-name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('dp-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dp-office-number">Office number</label>
                                <input type="text" class="form-control validate{{ $errors->first('dp-office-number') ? ' animated shake' : '' }}" data-error="{{ $errors->first('dp-office-number') }}" name="dp-office-number" value="{{ old('dp-office-number') }}" id="dp-office-number">
                                @if ($errors->has('dp-office-number'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('dp-office-number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Manager</label>
                                <select name="dp-manager-id" class="form-control">
                                    <option value="" disabled selected>Choose one</option>
                                    @if(sizeof($employees))
                                        @foreach($employees as $em)
                                            <option value="{{$em->id}}">{{$em->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('dp-manager-id'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('dp-manager-id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <a href="{{ url('/department') }}" class="btn btn-lg btn-danger">
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
@endsection

@section('script')
    <script type="text/javascript" src="{{URL::asset('js/dp_validation.js')}}"></script>
    <script>
        $(document).ready(function () {
            var flag = $('#flag').val();
            var msg = '';
            var type = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New department successfully added.';
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