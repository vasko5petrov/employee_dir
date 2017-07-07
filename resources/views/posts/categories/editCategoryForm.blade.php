@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($result) && isset($alert_type))
            <div class="col s12 m8 offset-m2" hidden>
                <span id="result" value="{{ $result }}">{{ $result }}</span>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="color: white">Edit Category</h3>
                </div>
                <div class="panel-body" style="padding: 50px;">
                    <div>
                        {!! Form::open([
                                        'action' => array('PostsCategoriesController@edit', $pcat->id),
                                        'files' => true,
                                        'method' => 'post',
                                    ]) !!}
                                    <div class="row">
                                    <div class="col-md-12">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label for="new-category-name">Name</label>
                                                <input type="text" class="form-control validate{{ $errors->first('new-category-name') ? ' animated shake' : '' }}" data-error="{{ $errors->first('new-category-name') }}" name="new-category-name" value="{{ $pcat->name }}" id="new-category-name" autofocus>
                                                @if ($errors->has('new-category-name'))
                                                    <span class="help-block">
                                                        <strong style="color: red;">{{ $errors->first('new-category-name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="new-category-importance">Importance</label>
                                                <select name="new-category-importance" class="form-control  validate{{ $errors->first('new-category-importance') ? ' animated shake' : '' }}" data-error="{{ $errors->first('new-category-importance') }}" id="new-category-importance">
                                                    <option value="" disabled selected>Choose importance</option>
                                                    @foreach($categoriesNames as $key => $pcatName)
                                                    @if ($pcat->importance == $key)
                                                        <option value="{{$key}}" selected>{{$pcatName}}</option>
                                                    @else
                                                        <option value="{{$key}}">{{$pcatName}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('new-category-importance'))
                                                    <span class="help-block">
                                                    <strong style="color: red;">{{$errors->first('new-category-importance')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-success" type="submit">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                                <a href="{{ url('/posts/categories') }}" class="btn btn-lg btn-danger">
                                                    <i class="fa fa-times"></i> Cancel
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                        {!! Form::close() !!}
                    </div>
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
