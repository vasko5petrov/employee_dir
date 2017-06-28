@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Departments
        @if(!Auth::guest())
            <a href="{{url('/department/add')}}" style="float: right;" class="btn btn-lg btn-success" title="Add employee">
                <i class="large material-icons">add</i>
            </a>
        @endif
        </h3>
        <hr>
        <div class="row">
        @foreach($departments as $index=>$dp)
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">{{$dp->name}}</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Office Number:</strong> {{$dp->office_number}}</p>
                    @if($dp->manager())
                        <p><strong>Manager:</strong> <a href="{{url('/employee').'/'.$dp->manager()->id.'/detail'}}"id="dpManager">{{$dp->manager()->name}}</a></p>
                    @endif
                </div>
                <div class="panel-footer">
                    <a href="{{url('/department').'/'.$dp->id.'/detail'}}" id="dpName">View Department</a>
                    <a href="{{url('/department').'/'.$dp->id.'/employee'}}" class="btn btn-primary btn-circle btn-lg" title="Employee list"><i class="fa fa-list" style=""></i></a>
                    @if(!Auth::guest())
                        <a href="{{url('/department').'/'.$dp->id.'/edit'}}" id="{{'show-edit-'.$dp->id}}" class="btn btn-success btn-circle btn-lg" title="Edit"><i class="fa fa-edit" style=""></i></a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.modal-trigger').leanModal();
        $('select').material_select();
        // Show/hide floating button on scroll
        $(window).scroll(function () {
            var btn  = $('.fixed-action-btn');
            btn.fadeOut();
        });
        $('#tbody').scroll(function () {
            var btn  = $('.fixed-action-btn');
            btn.fadeOut();
        });
        // Scroll end extension
        $.fn.scrollEnd = function(callback, timeout) {
            $(this).scroll(function(){
                var $this = $(this);
                if ($this.data('scrollTimeout')) {
                    clearTimeout($this.data('scrollTimeout'));
                }
                $this.data('scrollTimeout', setTimeout(callback,timeout));
            });
        };
        $(window).scrollEnd(function () {
            var btn  = $('.fixed-action-btn');
            btn.fadeIn();
        }, 1000);
        $('#tbody').scrollEnd(function () {
            var btn  = $('.fixed-action-btn');
            btn.fadeIn();
        }, 1000);
        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
            $('#deleteForm').submit();
        });

        {{--Show/hide edit form--}}

        $('[id^="show-edit-"]').on('click', function() {
            id = $(this).attr('id').substr(10);
            $('#info-' + id).hide();
            $('#edit-' + id).show();
        });

        $('[id^="cancel-"]').on('click', function() {
            id = $(this).attr('id').substr(7);
            $('#edit-' + id).hide();
            $('#info-' + id).show();
        });

        $('[id^="save-"]').on('click', function() {
            id = $(this).attr('id').substr(5);
            edit_data = $('#edit-' + id).children();
            $.ajax({
                type: 'POST',
                url:  '/department/' + id + '/edit',
                data: {
                    'dp-id': $('input[name="dp-id"]').val(),
                    'dp-name': edit_data.eq(1).children().eq(0).val(),
                    'dp-office-number': edit_data.eq(2).children().eq(0).val(),
                    'dp-manager-id': $('#selectManager').val(),
                    '_token': $('input[name=_token]').val()
                },
                success: function(data){
                    data = JSON.parse(data);
                    if (data.alert_type == 'success') {
                        $('#dpName').html(data.dp.name);
                        $('#dpOfficeNumber').html(data.dp.office_number);
                        $('#dpManager').html(data.dp.manager_name);

                        $('#edit-' + id).hide();
                        $('#info-' + id).show();
                    }
                    $toastContent = $('<span style="text-align: center;"><strong>' + data.result + '</strong></span>');
                    Materialize.toast($toastContent, 5000);
//                    $('#editAlert').html('<div class="alert alert-' + data.alert_type +' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="modal">&times;</button><strong>' + data.result + '</strong></div>');
//                    $('#editResult').openModal();
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    error = errors[Object.keys(errors)[0]][0];
                    $toastContent = $('<span style="text-align: center;"><strong>' + error + '</strong></span>');
                    Materialize.toast($toastContent, 5000);
                }
            });
        });

        <!-- Mouse enter/leave a table row -->
        $('[id^="info-"]').mouseenter(function() {
            id = $(this).attr('id').substr(5);
            $('#action-' + id).css('visibility', 'visible');
        }).mouseleave(function() {
            id = $(this).attr('id').substr(5);
            $('#action-' + id).css('visibility', 'hidden');
        });
    </script>
@endsection
