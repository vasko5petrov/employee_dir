@extends('layouts.app')

@section('content')
    <div class="container">
        <h5>Departments</h5>
        <div class="divider"></div>
        @if(!Auth::guest())
            <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                <a href="{{url('/department/add')}}" class="btn-floating btn-large waves-effect waves-light green" title="Add department">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        @endif
        @if(sizeof($departments))
            <div class="row">
            @foreach($departments as $index=>$dp)
                <div class="col s12 m6">
                  <div class="card white black-text">
                    <div class="card-content black-text">
                      <p class="card-title">{{$dp->name}}</p>
                      <p><strong>Office Number:</strong> {{$dp->office_number}}</p>
                        @if($dp->manager())
                            <p><strong>Manager:</strong> <a href="{{url('/employee').'/'.$dp->manager()->id.'/detail'}}"id="dpManager">{{$dp->manager()->name}}</a></p>
                        @endif
                    </div>
                    <div class="card-action">
                        <a href="{{url('/department').'/'.$dp->id.'/detail'}}" id="dpName">View Department</a>
                        <a href="{{url('/department').'/'.$dp->id.'/employee'}}" class="btn-floating blue" title="Employee list"><i class="material-icons">view_list</i></a>
                            @if(!Auth::guest())
                                <a class="btn-floating green" title="Edit" href="{{url('/department').'/'.$dp->id.'/edit'}}" id="{{'show-edit-'.$dp->id}}"><i class="material-icons">mode_edit</i></a>
                                <!--<form role="form" method="POST" action="{{url('/department').'/'.$dp->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
                                    <button class="btn-floating red modal-trigger" type="button" href="#confirmDelete" title="Delete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </form>-->
                            @endif
                    </div>
                  </div>
                </div>
            @endforeach
            </div>
            <center>
                {!! $departments->render() !!}
            </center>
        @endif
    </div>

    <!-- Edit result modal -->
    <div class="modal fade" id="editResult" role="dialog">
        <div class="modal-dialog" style="margin-top: 5%">
            <div class="col-sm-8 col-sm-offset-2" id="editAlert" style="text-align: center">
            </div>
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
