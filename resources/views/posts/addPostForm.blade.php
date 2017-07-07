@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($flag))
            <div class="col-md-12">
                <input id="flag" value="{{ $flag }}" type="text" disabled hidden>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Add Article</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                                            {{--<link href="{{URL::asset('css/avatar.css')}}" rel="stylesheet" >--}}
                    {!! Form::open([
                        'action' => 'PostsController@add',
                        'files' => true,
                        'method' => 'post'
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
                                <label for="post-name">Article Title</label>
                                <input type="text" class="form-control validate{{ $errors->first('post-title') ? ' animated shake' : '' }} " data-error="{{ $errors->first('post-title') }}" name="post-title" value="{{ old('post-title') }}" id="post-title" autofocus>
                                @if ($errors->has('post-title'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('post-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="post-body">Article Body</label>
                                <textarea name="post-body" id="post-body" class="form-control ckeditor validate{{ $errors->first('post-body') ? ' animated shake' : ''}}" data-error="{{ $errors->first('post-body') }}"></textarea>
                                @if ($errors->has('post-body'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('post-body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="post-category-id">Category</label>
                                <select name="post-category-id" class="form-control">
                                    <option value="" selected disabled>Choose Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('post-category-id'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{$errors->first('post-category-id')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="form-group">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-save"></i> Create Article
                                </button>
                                <a href="{{ url('/posts') }}" class="btn btn-lg btn-danger">
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

            var flag = $('#flag').val();
            var msg = '';
            var type = '';
            if (flag) {
                if (flag == 1) {
                    msg = 'New article successfully created.';
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
