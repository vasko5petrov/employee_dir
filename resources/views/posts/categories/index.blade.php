@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        @if(isset($flag))
            <div class="col s12 m8 offset-m2">
                <input id="flag" value="{{ $flag }}" type="text" disabled hidden>
            </div>
            {{$flag}}
        @endif
    </div>
    @if(!Auth::guest())
        <h3>Manage categories
        @if(!Auth::guest())
            <a style="float: right;" class="btn btn-xl btn-success btn-circle" data-toggle="modal" data-target="#createCategoryModal" title="Add category">
                <i class="fa fa-plus"></i>
            </a>
        @endif
        </h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
            <a data-toggle="collapse" href="#collapse-search-form" class="btn btn-primary btn-block">Search</h4></a>
                <br>
                <div id="collapse-search-form" class="collapse">
                    <form method="GET" url="posts/categories" id="search-form" >
                        <input type="hidden" name="search" value=1>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cat-search-name" placeholder="Category Name" value="" />
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

            <!-- Modal -->
              <div class="modal fade" id="createCategoryModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Create category</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('/posts/category/add') }}">
                        <div class="row">
                            <div class="col-md-12">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="category-name">Name</label>
                                    <input type="text" class="form-control validate{{ $errors->first('category-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('category-name') }}" name="category-name" value="{{ old('category-name') }}" id="category-name" autofocus>
                                    @if ($errors->has('category-name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('category-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Importance</label>
                                    <select name="category-importance" class="form-control validate{{ $errors->first('category-importance') ? ' animated shake' : '' }}" data-error="{{ $errors->first('category-importance') }}" value="{{ old('category-importance') }}" id="category-importance">
                                        <option value="" disabled selected>Choose importance</option>
                                        <option value="0">Default</option>
                                        <option value="1">Info</option>
                                        <option value="2">Attention</option>
                                        <option value="3">Very Important</option>
                                        <option value="4">Extremly Important</option>
                                    </select>
                                    @if ($errors->has('category-importance'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('category-importance') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button class="btn btn-lg btn-success" type="submit">
                                <i class="fa fa-save"></i> Save
                            </button>
                            <a href="{{ url('/posts/categories') }}" class="btn btn-lg btn-danger">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>

                    </form>
                  </div>
                  
                </div>
              </div>

            @if(sizeof($postsCategories))
                <link href="{{URL::asset('css/search_form.css')}}" rel="stylesheet" >
                <table class="table tablesorter table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Importance</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            
                            <th class="disabled">Actions</th>
                            
                        </tr>
                    <tbody id="tbody">
                    @foreach($postsCategories as $index=>$pcat)
                        <tr id="{{'info-'.$pcat->id}}">
                            <div>
                                <td>{{($postsCategories->currentPage()-1)*15+$index+1}}</td>
                                <td><a href="{{url('/posts/category').'/'.$pcat->id}}">{{$pcat->name}}</a></td>
                                <td>{{$categoriesNames[$pcat->importance]}}</td>
                                <td>{{$pcat->created_at}}</td>
                                <td>{{$pcat->updated_at}}</td>
                                <td style="width: 100px;">
                                    <div id="{{'action-'.$pcat->id}}">
                                        <a href="{{url('/posts/category').'/'.$pcat->id.'/edit'}}" class="btn btn-primary btn-lg btn-circle" title="Edit" id="{{'show-edit-'.$pcat->id}}"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                <center>
                    {!! $postsCategories->render() !!}
                </center>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h5>No Categories found.</h5>
                    </div>
                </div>
            @endif
            </div>
        </div>
        @else
            <div class="row">
                <div class="alert alert-warning">
                  <strong>Warning!</strong> You are not authorized!
                </div>
            </div>
        @endif
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var flag = $('#flag').val();
            var msg = '';
            var type = '';

            if($('#category-name').hasClass('animated shake') || $('#category-importance').hasClass('animated shake')) {
                $('#createCategoryModal').modal('show');
            }
            if (flag) {
                if (flag == 1) {
                    msg = 'New category successfully added.';
                    type = 'success';
                }
                else {
                    msg = 'Error. Please try again.';
                    type = 'danger'
                }

                $.bootstrapGrowl(
                    msg,{
                    type: type,
                    delay: 2000,
                });
            }
        });
    </script>
@endsection