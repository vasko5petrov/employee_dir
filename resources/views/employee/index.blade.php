@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Employees
                        <div class="pull-right">
                            @if(!Auth::guest())
                                <a href="{{url('/employee/add')}}" class="btn btn-primary btn-xs" title="Add new employee">
                                    <i class="fa fa-btn fa-plus" aria-hidden="true"></i>Add
                                </a>
                            @endif
                            <a href="#" class="btn btn-primary btn-xs" title="Search employees" id ="show-search">
                                <i class="fa fa-btn fa-search" aria-hidden="true"></i>Search
                            </a>
                            
                            <form method="GET", url="employee", class="form navbar-form {!! $search ? 'search-ed' : 'search' !!}" id="search-form" >
                                <input type="hidden" name="search" value=1>
                                <div class="form-group">
                                    <input type="text" class="input-sm form-control" name="em-search-name" placeholder="Employee Name" value="{{$em_search_name}}">
                                </div>
                                <div class="form-group">
                                    <select class="form-control input-sm" name="em-search-dp">
                                        <option value="">Department</option>
                                        @foreach($departments as $dp)
                                            @if ($dp->id == $em_search_dp)
                                                <option value="{{$dp->id}}" selected>{{$dp->name}}</option>
                                            @else
                                                <option value="{{$dp->id}}">{{$dp->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn-sm btn btn-default">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="panel-body">
                        <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Job Title</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th></th>
                                </tr>
                            <tbody>
                            @foreach($employees as $index=>$em)
                                <tr>
                                    <div>
                                        <td>{{($employees->currentPage()-1)*8+$index+1}}</td>
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
                                            <td>
                                                <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn btn-primary btn-xs" title="Edit employee">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>

                                                {{--Modal for delete confirmation--}}
                                                <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Delete employee</h4>
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
                                                <form role="form" method="POST" action="{{url('/employee').'/'.$em->id.'/delete'}}" accept-charset="UTF-8" style="display:inline">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" class="form-control" name="em-id" value="{{$em->id}}">
                                                    <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete employee">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
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

        <!-- Show search form -->
        $('#show-search').on('click', function() {
            $('#search-form').toggle('fast', function() {
                if ($(this).is(':visible')) {
                    $(this).css('display', 'inline');
                }
            });
            $('input:text:visible:first').focus();
        });

    </script>
@endsection