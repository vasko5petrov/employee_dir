@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Employee details</h5>
                    <div>
                        <div class="row">
                            <div class="col s12">
                                <div class="col s4" align="center">
                                    <img alt="Employee picture" src="{{url('/').'/'.$em->picture}}" class="circle responsive-imge" style="width: 80%;">
                                </div>
                                <div class="employeeDetails col s8">
                                    <h5>Basic info</h5>
                                    <table class="">
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
                                        </tbody>
                                    </table >
                                    <h5>Personal info</h5>
                                    <table class="">
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
                                    <table class="">
                                        <tbody>
                                            <tr>
                                                <th>Department</th>
                                                <td>{{$dp->name}}</td>
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
                                </div>
                            </div>
                            <div class="col s12">
                                @if(!Auth::guest())
                                <table>
                                    <td style="width: 100px;">
                                        <div id="confirmDelete" class="modal">
                                            <div class="modal-content">
                                                <p>Are you sure want to delete this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button href="#" class="modal-action modal-close waves-effect waves-light btn-flat">Cancel</button>
                                                <button id="confirm" class="modal-action modal-close waves-effect waves-light btn-flat red">Delete</button>
                                            </div>
                                        </div>
                                        <div id="{{'action-'.$em->id}}">
                                        <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn-floating green" title="Edit" id="{{'show-edit-'.$em->id}}"><i class="material-icons">mode_edit</i></a>
                                        <form role="form" method="POST" action="{{url('/employee').'/'.$em->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" class="form-control" name="em-id" value="{{$em->id}}">
                                            <button class="btn-floating red modal-trigger" type="button" href="#confirmDelete" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                        </div>
                                    </td>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection