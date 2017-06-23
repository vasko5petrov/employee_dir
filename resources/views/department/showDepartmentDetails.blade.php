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
                </div>
            </div>
        </div>
    </div>
@endsection