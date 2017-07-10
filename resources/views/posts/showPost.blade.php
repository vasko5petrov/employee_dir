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
        <h5><a style="text-decoration: none;" href="{{url('/posts/category/'.$post_category_id)}}"><span class="label label-{{$importanceLabels[$post_category_importance]}}">{{$post_category_name}}</span></a></h5>
        <hr>
        <div class="row">
            <div class="col-md-9">
                <div class="well">
                    <p class="text-muted">{{$post->created_at}}</p>
                    <img src="{{url('/').'/'.$post->cover_image}}" class="responsive-imge" style="width: 100%;">
                    <p>{!! $post->body !!}</p>                    
                </div>
                <hr>
                <h6>Attached files: </h6>
                @if($unserialized_files_array)
                <ul class="list-group-horizontal">
                @foreach ($unserialized_files_array as $index => $element)
                    @if(substr($element, -4) == '.pdf' )
                    <a data-toggle="modal" data-target="#attachedFile{{$index}}" href="#" >
                    <li class="list-group-item">
                        <h6>{{$filesNames[$index]}}</h6>
                        <small>Open file</small>
                    </li>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="attachedFile{{$index}}" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{url($element)}}" width="100%" height="800"></iframe>
                            </div>
                        </div>
                          
                        </div>
                    </div>
                    @else
                        @if(substr($element, -4) == '.png'  || substr($element, -4) == '.jpg')
                            <a href="{{url($element)}}" target="_blank"><li class="list-group-item"><img src="{{url($element)}}" width="100" alt="attached_image" class="attached_image"></li></a>
                        @else
                            <a href="{{url($element)}}" target="_blank">                            
                                <li class="list-group-item">
                                <h6>{{$filesNames[$index]}}</h6>
                                <small>Download file</small>
                                </li>
                            </a>
                        @endif
                    @endif
                @endforeach
                
                @else
                    No attached files.
                @endif
                </ul>
                <hr>
            </div>
            <div class="col-md-3">
                <ul class="list-group">
                    @foreach($posts as $index=>$cat_post)
                    
                    <div class="row">
                        <div class="col-sm-4"><a href="{{url('/post').'/'.$cat_post->id}}"><img src="{{url('/').'/'.$cat_post->cover_image}}" class="responsive-imge" style="width: 100%;"></a>
                        </div>
                        <div class="col-sm-8">
                          <h6 class="title"><a href="{{url('/post').'/'.$cat_post->id}}">{{$cat_post->title}}</a></h6>
                          <p class="text-muted">{{$cat_post->created_at}}</p>                      
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </ul>
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
