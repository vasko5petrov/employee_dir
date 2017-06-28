@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="card-title">Department details</h3>
        <hr>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <h5>
                <a href="{{url('/department').'/'.$dp->id.'/detail'}}">{{$dp->name}}</a>
                <a href="{{url('/department').'/'.$dp->id.'/employee'}}"><span class="badge badge-info pull-right">{{ $number_employees }} {{ $number_employees != 1 ? 'employees' : 'employee' }}</span></a>
            </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 departmentDetails">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Office number</th>
                            <td>{{$dp->office_number}}</td>
                        </tr>
                        <tr>
                            <th>Manager</th>
                            <td>{{$dp->manager_name}}</td>
                        </tr>
                    </tbody>
                </table >
                    <table>
                        <tr style="width: 100px;">
                            <a href="{{url('/department').'/'.$dp->id.'/employee'}}" class="btn btn-primary btn-circle btn-lg" title="Employee list"><i class="fa fa-list" style=""></i></a>
                            @if(!Auth::guest())
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
                                    <form role="form" method="POST" action="{{url('/department').'/'.$dp->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
                                        <button class="btn btn-danger" type="submit" title="Delete">Delete</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @if(!Auth::guest())
                                <a href="{{url('/department').'/'.$dp->id.'/edit'}}" id="{{'show-edit-'.$dp->id}}" class="btn btn-success btn-circle btn-lg" title="Edit"><i class="fa fa-edit" style=""></i></a>
                                <button class="btn btn-danger btn-lg btn-circle" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete"><i class="fa fa-trash"></i></button> 
                            @endif
                            @endif
                        </tr>
                    </table>
            </div>
        </div>
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