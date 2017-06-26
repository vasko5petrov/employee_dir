@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">
                            <a href="{{url('/department').'/'.$dp->id.'/detail'}}">{{$dp->name}}</a>
                            <span class="chip right"><a href="{{url('/department').'/'.$dp->id.'/employee'}}">{{ $number_employees }} {{ $number_employees != 1 ? 'employees' : 'employee' }}</a></span>
                        </h5>
                        <table class="responsive-table">
                            <tbody>
                            <tr>
                                <th>Office number</th>
                                <th>Manager</th>
                            </tr>
                            <tr>
                                <td>{{$dp->office_number}}</td>
                                <td>{{$dp->manager_name}}</td>
                            </tr>
                            </tbody>
                        </table >
                    </div>
                    <div class="card-action">
                        <a href="{{url('/department').'/'.$dp->id.'/employee'}}" class="btn-floating blue" title="Employee list"><i class="material-icons">view_list</i></a>
                            @if(!Auth::guest())
                                <a class="btn-floating green" title="Edit" href="{{url('/department').'/'.$dp->id.'/edit'}}" id="{{'show-edit-'.$dp->id}}"><i class="material-icons">mode_edit</i></a>
                                <form role="form" method="POST" action="{{url('/department').'/'.$dp->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="form-control" name="dp-id" value="{{$dp->id}}">
                                    <button class="btn-floating red modal-trigger" type="button" href="#confirmDelete" title="Delete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </form>
                            @endif
                    </div>
                    <div id="confirmDelete" class="modal">
                        <div class="modal-content">
                            <p>Are you sure want to delete this?</p>
                        </div>
                        <div class="modal-footer">
                            <button href="#" class="modal-action modal-close waves-effect waves-light btn-flat">Cancel</button>
                            <button id="confirm" class="modal-action modal-close waves-effect waves-light btn-flat red">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
