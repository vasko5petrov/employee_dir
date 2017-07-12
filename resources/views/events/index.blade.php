@extends('layouts.app')

@section('content')
        
    <div class="container">
        <h3>Events
        @if(!Auth::guest())
            <a href="{{url('/event/add')}}" style="float: right;" class="btn btn-xl btn-success btn-circle" title="Add event">
                <i class="fa fa-plus"></i>
            </a>
        @endif
        </h3>
        <hr>
        <div class="row">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
 $(document).ready(function() {
  
	var base_url = '{{ url('/') }}';
	 
	$('#calendar').fullCalendar({
			weekends: true,
			header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: {
			url: base_url + '/api',
			error: function() {
				alert("cannot load json");
			}
		}
	});


 });
</script>
@endsection