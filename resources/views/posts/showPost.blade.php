@extends('layouts.app')

@section('content')
    <div class="container">

    @if(isset($post))

        <h3>{{$post->title}}
        @if(!Auth::guest())
            <a href="{{url(url('/post').'/'.$post->id.'/edit')}}" style="float: right;" class="btn btn-xl btn-primary btn-circle" title="Edit post">
                <i class="fa fa-edit"></i>
            </a>
        @endif
        </h3>
        <h5><span class="label label-{{$importanceLabels[$post_category_importance]}}">{{$post_category_name}}</span></h5>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;">
                    <p>{!! $post->body !!}</p>
                </div>
            </div>
            
        </div>
        @if(!Auth::guest())
                    <table>
                        <td style="width: 100px;">
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
                                <form role="form" method="POST" action="{{url('/post').'/'.$post->id.'/delete'}}" accept-charset="UTF-8" style="display:inline" id="deleteForm">
                                {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="form-control" name="post-id" value="{{$post->id}}">
                                    <button type="submit" id="confirm" class="btn btn-danger">Delete Article</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="{{'action-'.$post->id}}">
                            <button class="btn btn-danger btn-lg btn-circle" type="button" data-toggle="modal" data-target="#confirmDelete" title="Delete"><i class="fa fa-trash"></i></button>  
                        </div>
                        </td>
                    </table>
                @endif

    </div>

    @endif
@endsection
