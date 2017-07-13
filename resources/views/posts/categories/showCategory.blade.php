@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="card-title">Category details</h3>
        <hr>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <h5>
                {{$category->name}}
            </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 departmentDetails">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Posts</th>
                            <td>{{$number_posts}}</td>
                        </tr>
                        <tr>
                            <th>Importance</th>
                            <td>{{$categoriesNames[$category->importance]}}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{$category->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{$category->updated_at}}</td>
                        </tr>
                    </tbody>
                </table >
                    <table>
                        <tr style="width: 100px;">
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
                                    <form role="form" method="POST" action="{{url('/posts/category').'/'.$category->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" class="form-control" name="dp-id" value="{{$category->id}}">
                                        <button class="btn btn-danger" type="submit" title="Delete">Delete Category</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @if(!Auth::guest())
                                <a href="{{url('/posts/category').'/'.$category->id.'/edit'}}" id="{{'show-edit-'.$category->id}}" class="btn btn-primary btn-circle btn-lg" title="Edit"><i class="fa fa-edit" style=""></i></a>
                                <button class="btn btn-danger btn-lg btn-circle" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete"><i class="fa fa-trash"></i></button> 
                            @endif
                            @endif
                        </tr>
                    </table>
            </div>
        </div>
        @if(sizeof($posts))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($posts as $index=>$post)
                    <div class="panel panel-default">
                        <a href="{{url('/post').'/'.$post->id}}"><img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;"></a>
                        <div class="panel-body">
                            <h3 style="margin-top: 0px;"><a href="{{url('/post').'/'.$post->id}}">{{$post->title}}</a></h3>
                            <p>{!! str_limit($post->body, $limit = 150, $end = '...') !!}</p>
                        </div>
                        <div class="panel-footer">
                            @foreach($categories as $key=>$cat)
                              @if($cat->id == $post->post_category_id) 
                                <span class="label label-{{$importanceLabels[$cat->importance]}}">{{$cat->name}}</span>
                              @endif
                            @endforeach
                            @if(count(json_decode($post->attached_files)) != 0)
                                <a data-toggle="tooltip" title="Attachments" data-placement="right"><i class="fa fa-files-o" style="font-size: 16px"></i></a>
                            @endif
                            <p class="pull-right">{{$postedOn[$index]}}</a></p>
                        </div>
                    </div>
                @endforeach
                <center>
                    {!! $posts->render() !!}
                </center>
            </div>
        </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h5>No Posts found.</h5>
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