@extends('layouts.app')

@section('content')
    <div class="container animated zoomIn">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Departments
                        @if(!Auth::guest())
                            <div class="pull-right">
                                <a href="{{url('/department/add')}}" class="btn btn-primary btn-xs" title="Add new department">
                                    <i class="fa fa-btn fa-plus" aria-hidden="true"></i>Add
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Office Number</th>
                                    <th>Manager</th>
                                    <th></th>
                                </tr>
                            <tbody>
                                @foreach($departments as $index=>$dp)
                                    <tr>
                                        <td>{{($departments->currentPage()-1)*10+$index+1}}</td>
                                        <td><a href="{{url('/department').'/'.$dp->id.'/detail'}}">{{$dp->name}}</a></td>
                                        <td>{{$dp->office_number}}</td>
                                        <td>
                                            @if($dp->manager())
                                                <a href="{{url('/employee').'/'.$dp->manager()->id.'/detail'}}">{{$dp->manager()->name}}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/department').'/'.$dp->id.'/employee'}}" class="btn btn-default btn-xs" title="Show employees">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                            @if(!Auth::guest())
                                                <a href="{{url('/department').'/'.$dp->id.'/edit'}}" class="btn btn-primary btn-xs" title="Edit department">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>

                                                {{--Modal for delete confirmation--}}
                                                <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Delete department</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure want to delete this?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form role="form" method="POST" action="{{url('/department').'/'.$dp->id.'/delete'}}" accept-charset="UTF-8" style="display:inline">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
                                                    <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete department">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                        <center>
                            {!! $departments->render() !!}
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        {{--Modal confirm script--}}
        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });
    </script>
@endsection