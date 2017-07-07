@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col-md-12">
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="card-title" style="color: white">Edit article</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                                            {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                    {!! Form::open([
                        'action' => array('PostsController@edit', $post->id),
                        'files' => true,
                        'method' => 'post',
                    ]) !!}
                        <div class="row">
                            <div class="form-group">
                                <label class="input-group-btn">
                                <span class="btn btn-warning">
                                    Choose cover image {!! Form::file('image', ['id'=>'picture', 'class'=>'form-control-file', 'style'=>'display:none;' ]) !!}
                                </span>
                                </label>
                                <input type="file" style="display: none;" multiple/>
                                <input type="text" class="form-control" style="padding-left: 10px;" readonly/>

                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="post-title">Article Title</label>
                                <input type="hidden" name="post-id" value="{{$post->id}}">
                                <input type="text" class="form-control validate{{ $errors->first('post-title') ? ' animated shake' : '' }}" data-error="{{ $errors->first('post-title') }}" name="post-title" value="{{ $post->title }}" id="post-title" autofocus>
                                @if ($errors->has('post-title'))
                                    <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('post-title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="post-body">Article Body</label>
                                <textarea name="post-body" id="post-body" class="form-control ckeditor validate{{ $errors->first('post-body') ? ' animated shake' : '' }}" data-error="{{ $errors->first('post-body') }}">{{ $post->body }}</textarea>
                                @if ($errors->has('post-body'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('post-body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="post-category-id" class="form-control">
                                    @if(sizeof($categories))
                                        <option value=""></option>
                                        @foreach($categories as $cat)
                                            @if ($cat->id == $post->post_category_id)
                                                <option value="{{ $post->post_category_id }}" selected>{{ $post_category_name }}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('post-category-id'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('post-category-id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Save Article
                                </button>
                                <a href="{{ url('/post/'.$post->id) }}" class="btn btn-lg btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
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
