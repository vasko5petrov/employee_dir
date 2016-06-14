@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">
                            <a href="{{url('/department').'/'.$dp->id.'/detail'}}">{{$dp->name}}</a>
                            <span class="chip right">{{ sizeof($employees) }} {{ sizeof($employees) != 1 ? 'employees' : 'employee' }}</span>
                        </h5>
                        @if(sizeof($employees))
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                </tr>
                                <tbody>
                                @foreach($employees as $index=>$em)
                                    <tr>
                                        <td>{{($employees->currentPage()-1)*10+$index+1}}</td>
                                        <td><a href="{{url('/employee').'/'.$em->id.'/detail'}}">{{$em->name}}</a></td>
                                        <td>{{$em->job_title}}</td>
                                        <td>{{$em->email}}</td>
                                        <td>{{$em->phone_number}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </thead>
                            </table>
                            <center>
                                {!! $employees->render() !!}
                            </center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection