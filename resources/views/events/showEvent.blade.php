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
		<div class="col-lg-12">
			<h2>{{ $event->title }} <small>booked by {{ $event->name }}</small></h2>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			
			<p>Time: <br>
			{{ date("g:ia\, jS M Y", strtotime($event->start_time)) . ' until ' . date("g:ia\, jS M Y", strtotime($event->end_time)) }}
			</p>
			
			<p>Duration: <br>
			{{ $duration }}
			</p>
			
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