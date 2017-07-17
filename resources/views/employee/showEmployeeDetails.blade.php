@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="card-title">Employee details</h3>
    <hr>
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12">
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    
    @if(isset($em))
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
             <img alt="Employee picture" src="{{url('/').'/'.$em->picture}}" class="circle responsive-imge" style="width: 50%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 employeeDetails">
            <h5>Basic info</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$em->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$em->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{$em->phone_number}}</td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td>{{$em->ip_address}}</td>
                        </tr>
                    </tbody>
                </table >
            <h5>Personal info</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Gender</th>
                            <td>{{$em->gender}}</td>
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td>{{$em_birthday}}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{$em->location}}</td>
                        </tr>
                    </tbody>
                </table>
            <h5>Work info</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Department</th>
                            <td>
                                @if(sizeof($dp))
                                    {{$dp->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Job Title</th>
                            <td>{{$em->job_title}}</td>
                        </tr>
                        <tr>
                            <th>Hiring Date</th>
                            <td>{{$em_hiringDate}}</td>
                        </tr>
                    </tbody>
                </table>
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
                                <form role="form" method="POST" action="{{url('/employee').'/'.$em->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="form-control" name="em-id" value="{{$em->id}}">
                                    <button type="submit" id="confirm" class="btn btn-danger">Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="{{'action-'.$em->id}}">
                            <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$em->id}}"><i class="fa fa-edit"></i></a>
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