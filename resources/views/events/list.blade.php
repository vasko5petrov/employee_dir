@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="card-title">Manage events</h3>
    <hr>
    <div class="row">
    <div class="col-md-12">
        @if(sizeof($events))
                <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
                <table class="table tablesorter table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event's Title</th>
                            <th>Start</th>
                            <th>End</th>
                            @if(!Auth::guest())
                                <th class="disabled">Actions</th>
                            @endif
                        </tr>
                    <tbody id="tbody">
                    @foreach($events as $index=>$ev)
                        <tr id="{{'info-'.$ev->id}}">
                            <div>
                                <td>{{$index+1}}</td>
                                <td><a href="{{url('/events').'/'.$ev->id}}">{{$ev->name}}</a></td>
                                <td>{{$ev->start_time}}</td>
                                <td>{{$ev->end_time}}</td>
                                @if(!Auth::guest())
                                    <td style="width: 100px;">
                                        <div id="{{'action-'.$ev->id}}">
                                            <a href="{{url('/event').'/'.$ev->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$ev->id}}"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                @endif
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h5>No Events found.</h5>
                    </div>
                </div>
            @endif
    </div>
</div>
</div>
@endsection