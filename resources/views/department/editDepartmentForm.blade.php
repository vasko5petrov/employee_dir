@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($errors) == 0 && isset($result) && isset($alert_type))
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-{{$alert_type}} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{$result}}</strong>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit department</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/department').'/'.$dp->id.'/edit'}}">
                            {!! csrf_field() !!}
                            <div class="form-group{{$errors->has('dp-name') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="dp-name" value="{{$dp->name}}" id="dp-name" autofocus>
                                    <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
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
                                    <input type="text" class="form-control" name="dp-office-number" id="dp-office-number" value="{{$dp->office_number}}">

                                    @if($errors->has('dp-office-number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('dp-office-number')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{$errors->has('dp-manager-id')? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Manager</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="dp-manager-id" >
                                        @if(sizeof($employees))
                                            @foreach($employees as $em)
                                                <option value="{{$em->id}}">{{$em->name}}</option>
                                            @endforeach
                                            @if(!$manager_name)
                                                <option selected></option>
                                            @else
                                                <option></option>
                                            @endif
                                        @else
                                            <option selected></option>
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
                                    <button type="submit" class="btn btn-primary" id="dp_button">
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