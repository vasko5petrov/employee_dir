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
                        <strong>Email sent!</strong>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Invite a new administrator</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/invite/send-invitation') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('admin-email') ? ' has-error' : ''}}">
                                <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="admin-email" value="{{old('admin-email')}}" autofocus>
                                    @if($errors->has('admin-email'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('admin-email')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-paper-plane-o"></i>Send invitation
                                    </button>
                                    <a type="button" class="btn btn-default" href="{{url('/')}}">
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