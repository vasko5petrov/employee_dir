@extends('layouts.app')

@section('content')
    <style>
        {{--Disable search functionality on mobile to use responsive table--}}
        .mobile-hide {
            display: none;
        }

        @media screen and (min-width: 1150px) {
            .mobile-hide {
                display: block;
            }
        }
        @media only screen and (min-width: 993px) {
            [id^='action'] {
                visibility: hidden;
            }
        }
    </style>
    <div class="container">
        <h5>Employees</h5>
        @if(!Auth::guest())
            <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                <a href="{{url('/employee/add')}}" class="btn-floating btn-large waves-effect waves-light green" title="Add employee">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        @endif
        <div class="col s12 mobile-hide">
            <a href="#" class="btn waves-effect waves-light right" title="Search employees" id ="show-search">
                <i class="material-icons left">search</i>Search
            </a>
            <form method="GET", url="employee", class="form navbar-form {!! $search ? 'search-ed' : 'search' !!}" id="search-form" >
                <input type="hidden" name="search" value=1>
                <div class="input-field s12 m6">
                    <input type="text" class="input-sm form-control" name="em-search-name" placeholder="Employee Name" value="{{$em_search_name}}">
                </div>
                <div class="input-field s12 m6">
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
                <button type="submit" class="btn waves-effect waves-light">
                    <i class="material-icons left">search</i>Search
                </button>
            </form>
            <button class="btn waves-effect waves-light" id="close-search-form">
                <i class="material-icons left">close</i>Close
            </button>
        </div>

        <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Job Title</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            <tbody id="tbody">
            @foreach($employees as $index=>$em)
                <tr id="{{'info-'.$em->id}}">
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
                                <div id="{{'action-'.$em->id}}">
                                <a href="{{url('/employee').'/'.$em->id.'/edit'}}" class="btn-floating green" title="Edit" id="{{'show-edit-'.$em->id}}"><i class="material-icons">mode_edit</i></a>
                                <div id="confirmDelete" class="modal">
                                    <div class="modal-content">
                                        <p>Are you sure want to delete this?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button href="#" class="modal-action modal-close waves-effect waves-light btn-flat">Cancel</button>
                                        <button id="confirm" class="modal-action modal-close waves-effect waves-light btn-flat red">Delete</button>
                                    </div>
                                </div>
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

        <!-- Show search form -->
        $(document).ready(function () {
            $('#close-search-form').hide();
            $('#search-form').hide();
            $('#show-search').on('click', function() {
                $('#show-search').hide();
                $('#close-search-form').show();
                $('#search-form').toggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $(this).css('display', 'inline');
                    }
                });
                $('input:text:visible:first').focus();
            });
            $('#close-search-form').on('click', function () {
                $('#close-search-form').hide();
                $('#show-search').show();
                $('#search-form').hide();
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