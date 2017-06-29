@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Employees
        @if(!Auth::guest())
            <a href="{{url('/employee/add')}}" style="float: right;" class="btn btn-xl btn-success btn-circle" title="Add employee">
                <i class="fa fa-plus"></i>
            </a>
        @endif
        </h3>
        <hr>
        <div class="row">
            <div class="col-md-9">
            <a data-toggle="collapse" href="#collapse-search-form" class="btn btn-primary btn-block">Search</h4></a>
                <br>
                <div id="collapse-search-form" class="collapse">
                    <form method="GET" url="employee" id="search-form" >
                        <input type="hidden" name="search" value=1>
                        <div class="form-group">
                            <input type="text" class="form-control" name="em-search-name" placeholder="Employee Name" value="{{$em_search_name}}" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="em-search-dp">
                                <option value="">All Departments</option>
                                @foreach($departments as $dp)
                                    @if ($dp->id == $em_search_dp)
                                        <option value="{{$dp->id}}" selected>{{$dp->name}}</option>
                                    @else
                                        <option value="{{$dp->id}}">{{$dp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="collapse" href="#collapse-search-form" id="close-search-form">
                            <i class="fa fa-close"></i> Close
                        </button>
                    </form>
                </div>
            <br>
            @if(sizeof($employees))
                <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
                <table class="table tablesorter table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Job Title</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            @if(!Auth::guest())
                                <th class="disabled">Actions</th>
                            @endif
                        </tr>
                    <tbody id="tbody">
                    @foreach($employees as $index=>$em)
                        <tr id="{{'info-'.$em->id}}">
                            <div>
                                <td>{{($employees->currentPage()-1)*15+$index+1}}</td>
                                <td><a href="{{url('/employee').'/'.$em->id.'/detail'}}">{{$em->name}}</a></td>
                                <td>
                                    @if($em->department)
                                        <a href="{{url('/department').'/'.$em->department->id.'/detail'}}">{{$em->department->name}}</a>
                                    @endif
                                </td>
                                <td>{{$em->job_title}}</td>
                                <td>{{$em->email}}</td>
                                <td>{{$em->phone_number}}</td>
                                @if(!Auth::guest())
                                    <td style="width: 100px;">
                                        <div id="{{'action-'.$em->id}}">
                                            <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$em->id}}"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                @endif
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                <center>
                    {!! $employees->render() !!}
                </center>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h5>No Employees found.</h5>
                        @if (!Auth::guest())
                            <p>You can start by adding one</p>
                            <a href="{{url('/employee/add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add Employee</a>
                        @endif
                    </div>
                </div>
            @endif
            </div>
            @if(sizeof($employees))
            <div class="col-md-3">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <i class="fa fa-user-plus text-primary"></i>
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            New buddies
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <h6>Find out who recently joined the team</h6>
                        @if(sizeof($new_em))
                        @foreach($new_em as $nb)
                        
                        <div class="chip well">
                        <a href="{{url('/employee').'/'.$nb->id.'/detail'}}">
                          <img src="{{url('/').'/'.$nb->picture}}" alt="Person" width="40" height="40">
                          {{$nb->name}}
                        </a>
                        </div>
                        @endforeach
                        @else
                            <p>No recently joined.</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <i class="fa fa-birthday-cake text-warning"></i>
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Birthday buddies
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        <h6>Check out whose birthday is today or up next</h6>
                        @if(sizeof($todays_bd))
                        <p>Today's {{ sizeof($todays_bd) != 1 ? 'birthdays' : 'birthday' }}:</p>
                            @foreach($todays_bd as $tbd)
                                <div class="chip well">
                                <a href="{{url('/employee').'/'.$tbd->id.'/detail'}}">
                                  <img src="{{url('/').'/'.$tbd->picture}}" alt="Person" width="40" height="40">
                                  {{$tbd->name}}
                                </a>
                                </div>
                            @endforeach
                        @else
                            <p>No birthdays today.</p>
                        @endif
                        @if(sizeof($next_bd))
                            <p>Future {{ sizeof($fnext_bd) != 1 ? 'birthdays' : 'birthday' }}:</p>
                            @foreach($next_bd as $key => $nbd)
                            <div class="chip well" data-toggle="tooltip" data-placement="top" title="{{$fnext_bd[$key]}}">
                            <a href="{{url('/employee').'/'.$nbd->id.'/detail'}}">
                              <img src="{{url('/').'/'.$nbd->picture}}" alt="Person" width="40" height="40">
                              {{$nbd->name}}
                            </a>
                            </div>
                            @endforeach
                        @else
                            <p>No future birthdays in the next 7 days.</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            @endif
        </div>

    </div>
@endsection
