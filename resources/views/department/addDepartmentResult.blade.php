@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New department</div>
                    <div class="panel-body">
                        <div class="alert alert-{{$alert_type}}" role="alert">
                            {{$result}}
                        </div>
                        @if($alert_type == 'success')
                            <a href="{{url('department')}}" class="btn btn-primary" role="button">
                                OK
                            </a>
                            <a href="{{url('department/add')}}" class="btn btn-default" role="button">
                                Add one more
                            </a>
                        @else
                            <a href="{{url('department/add')}}" class="btn btn-primary" role="button">
                                <i class="fa fa-btn fa-chevron-left"></i>Back
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection