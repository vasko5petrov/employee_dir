@extends('layouts.app')

@section('content')
<div class="container animated fadeInUp">
    <div class="row">
        <div class="col-md-9">
            <div class="jumbotron">
                <h1>Welcome</h1>
                <p>
                    This is the {{ config('app.name', 'Anakatech Family') }} office data website. <br>
                            View employees and departments. <br>
                            Check your own employee profile.
                </p>
                <a href="{{ url('/department') }}"><button type="button" class="btn btn-lg btn-default">Departments</button></a>
                <a href="{{ url('/employee') }}"><button type="button" class="btn btn-lg btn-primary">Employees</button></a>
            </div>
        </div>
        <div class="col-md-3">
            <h4>Recent News</h4>
            @if(count($posts) != 0)
                <ul class="list-group">
                @foreach ($posts as $index => $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title"><a href="{{url('/post').'/'.$post->id}}">{{$post->title}}</a></h3>
                        </div>
                        <a href="{{url('/post').'/'.$post->id}}"><img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;"></a>
                        <div class="panel-footer clearfix">
                            @if(count(json_decode($post->attached_files)) != 0)
                                <a data-toggle="tooltip" title="Attachments" data-placement="right"><i class="fa fa-files-o" style="font-size: 16px"></i></a>
                            @endif
                            <span class="pull-right">{{$postedOn[$index]}}</a></span>
                        </div>
                    </div>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
