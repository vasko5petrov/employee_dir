@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit department</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/department/edit').'/'.$dp->id }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="dp-name" value="{{$dp->name}}">
                                    <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Office number</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="dp-office-number" value="{{$dp->office_number}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Manager</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="dp-manager-id">
                                        @foreach($employees as $em)
                                            <option value="{{$em->id}}">{{$em->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-floppy-o"></i>Save
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