@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($errors) == 0 && isset($flag))
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>New department successfully added!</strong>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add department</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/department/add') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('dp-name') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="dp-name" value="{{old('dp-name')}}" autofocus>
                                    @if($errors->has('dp-name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('dp-name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('dp-office-number') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Office number</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="dp-office-number" value="{{old('dp-office-number')}}">
                                    @if($errors->has('dp-office-number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('dp-office-number')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('dp-manager-id') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Manager</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="dp-manager-id" >
                                        <option></option>
                                        @if(sizeof($employees))
                                            @foreach($employees as $em)
                                                <option value="{{$em->id}}">{{$em->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('dp-manager-id'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('dp-manager-id')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-floppy-o"></i>Save
                                    </button>
                                    <a type="button" class="btn btn-default" href="{{url('/department')}}">
                                        Cancel
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