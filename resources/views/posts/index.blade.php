@extends('layouts.app')

@section('content')
        
    <div class="container">
        <h3>News & Articles
        @if(!Auth::guest())
            <a href="{{url('/posts/add')}}" style="float: right;" class="btn btn-xl btn-success btn-circle" title="Add post">
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
                    <form method="GET" url="posts" id="search-form" >
                        <input type="hidden" name="search" value=1>
                        <div class="form-group">
                            <input type="text" class="form-control" name="post-search-title" placeholder="Search by title or content" value="{{$post_search_title}}" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="post-search-cat">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    @if ($cat->id == $post_search_cat)
                                        <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                    @else
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
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
            @if(sizeof($posts))
                @foreach($posts as $index=>$post)

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <a href="{{url('/post').'/'.$post->id}}"><img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;"></a>
                        <div class="panel-body">
                            <h3 style="margin-top: 0;"><a href="{{url('/post').'/'.$post->id}}">{{$post->title}}</a></h3>
                            <p>{!! str_limit($post->body, $limit = 150, $end = '...') !!}</p>
                        </div>
                        <div class="panel-footer">
                            @if($categories)
                            @foreach($categories as $key=>$cat)
                              @if($cat->id == $post->post_category_id)
                                <a style="text-decoration: none;" href="{{url('/posts/category/'.$cat->id)}}"><span class="label label-{{$importanceLabels[$cat->importance]}}">{{$cat->name}}</span></a>
                              @endif
                            @endforeach
                            @endif
                            @if(count(json_decode($post->attached_files)) != 0)
                                <a data-toggle="tooltip" title="Attachments" data-placement="right"><i class="fa fa-files-o" style="font-size: 16px"></i></a>
                            @endif
                            <p class="pull-right">{{$postedOn[$index]}}</a></p>
                        </div>
                    </div> 
                </div>
                @endforeach
                <center>
                    {!! $posts->render() !!}
                </center>
            @else
                <div class="row">
                    <div class="col-md-9">
                        <h5>No Posts found.</h5>
                    </div>
                </div>
            @endif
            </div>
            @if($categories)
            <div class="col-md-3">
                <ul class="list-group">
                    @foreach($categories as $key => $cat)
                        <li class="list-group-item"><a href="{{url('/posts/category/'.$cat->id)}}">{{$cat->name}}</a><span class="badge badge-default">{{$number_posts[$key]}}</span></li>
                    @endforeach
                </ul>
            </div>
            @endif
            
        </div>

    </div>
@endsection
