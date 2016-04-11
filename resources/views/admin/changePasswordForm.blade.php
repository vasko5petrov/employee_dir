@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/change-password') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Old password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="old-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">New password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="new-password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Retype new password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="retype-new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-floppy-o"></i>Save change
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection