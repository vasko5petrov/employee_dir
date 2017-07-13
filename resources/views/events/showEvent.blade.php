@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="card-title">Event details</h3>
    <hr>
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12">
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    
    @if(isset($event))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{ $event->title }}</h2>
            <p class="well">
                {{ $event->description }}
            </p>
            <hr>
        <div class="col-xs-6">
            <h6>When:</h6>
            <p><i class="fa fa-calendar"></i> {{ date('g:ia\, jS M Y', strtotime($event->start_time)) . ' until ' . date('g:ia\, jS M Y', strtotime($event->end_time)) }}</p>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <h6>Duration:</h6>
                <p><i class="fa fa-calendar"></i> {{ $duration }} </p>
            </div>
        </div>
                @if(!Auth::guest())
                    <table>
                        <td style="width: 100px;">
                        <div id="confirmDelete" class="modal">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Are you sure want to delete this?</h4>
                              </div>
                              <div class="modal-body">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <form role="form" method="POST" action="{{url('/event').'/'.$event->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="form-control" name="event-id" value="{{$event->id}}">
                                    <button type="submit" id="confirm" class="btn btn-danger">Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="{{'action-'.$event->id}}">
                            <a href="{{url('/event').'/'.$event->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$event->id}}"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-lg btn-circle" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete"><i class="fa fa-trash"></i></button>  
                        </div>
                        </td>
                    </table>
                @endif

        </div>
    </div>
    </div>
    @endif
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            var msg = $('#result');
            if(msg.length >= 1) {
                $.bootstrapGrowl(
                    msg,{
                    type: 'success',
                    delay: 2000,
                });
            }
        });
    </script>
@endsection