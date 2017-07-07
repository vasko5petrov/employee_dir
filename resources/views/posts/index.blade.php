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
                            <input type="text" class="form-control" name="post-search-title" placeholder="Post Title" value="" />
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
                
                <div class="row">
                    <div class="col-sm-4"><a href="{{url('/post').'/'.$post->id}}"><img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;"></a>
                    </div>
                    <div class="col-sm-8">
                      <h3 class="title"><a href="{{url('/post').'/'.$post->id}}">{{$post->title}}</a></h3>
                    @if($categories)
                    @foreach($categories as $key=>$cat)
                      @if($cat->id == $post->post_category_id) 
                        <span class="label label-{{$importanceLabels[$cat->importance]}}">{{$cat->name}}</span>
                      @endif
                    @endforeach
                    @endif
                      <p>{!! str_limit($post->body, $limit = 150, $end = '...') !!}</p>
                      
                      <p class="text-muted">{{$post->created_at}}</a></p>
                      
                    </div>
                </div>
                <hr>
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
                        <a href="{{url('/posts/category/'.$cat->id)}}"><li class="list-group-item">{{$cat->name}}<span class="badge badge-default">{{$number_posts[$key]}}</span></li></a>
                    @endforeach
                </ul>
            </div>
            @endif
            
        </div>

    </div>
@endsection
