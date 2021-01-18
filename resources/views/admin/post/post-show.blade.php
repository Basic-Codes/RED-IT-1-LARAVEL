<x-admin-master>

@section('content')
<div class="container">
    <div class="row">

      <!-- Post Content Column -->
      <div class="col-xl-12">

        <h1 class="mt-4">

          {{$post->title}}
          @auth
          <form action="{{route('upvote', $post->id)}}" method="POST" class="d-inline">
            @csrf
            <button type="submit"  
              @if ($post->UserAlreadyVoted() == "up")
                class="text-primary"
              @endif 
            class="border-0"><i class="fas fa-arrow-circle-up"></i></button>
          </form>
          <span>{{$post->GetPostVotesCount()}}</span>
          <form action="{{route('downvote', $post->id)}}" method="POST" class="d-inline">
            @csrf
            <button type="submit"  
              @if ($post->UserAlreadyVoted() == "down")
                class="text-danger"
              @endif 
            class="border-0"><i class="fas fa-arrow-circle-down"></i></button>
          </form>
          @endauth

          <small class="h6">
            @auth                
            @if ($post->userBT->id == Auth::user()->id)
                <a href="{{route('post.edit', $post)}}" class="btn btn-sm text-primary">
                    Edit Profile
                    <i class="fas fa-edit"></i>
                </a>
            @endif
            @endauth
          </small>
        </h1>
        <p class="lead">
          by
          <a href="{{route('user.profile', $post->userBT)}}">{{$post->userBT->name}}</a>
        </p>
        <hr>
        <p>Posted {{$post->created_at->diffForHumans()}}</p>
        <hr>
        @if ($post->post_image)
          {{-- <img class="img-fluid rounded" src="https://picsum.photos/seed/xxx/900/300" alt="Image Not Found"> --}}
          <img class="img-fluid rounded" style="width: 100%" src="{{$post->post_image}}" alt="Image Not Found">
        @endif
        <hr>
        <h5><p class="lead">{!!$post->content!!}</p> </h5>   
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="{{route('comment.store', $post->id)}}" method="POST">
              @csrf
              <div class="form-group">
                <textarea name="comment_content" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        @foreach ($post->GetPostComments as $comment_i)
          <!-- Comment with nested comments -->
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" width="40px" src="{{$comment_i->usersBT->profile_pic}}" alt="">
            <div class="media-body">
            <h5 class="mt-0">{{$comment_i->usersBT->name}}</h5>
            {{$comment_i->comment_content}}
            <div class="media mt-4">
                <div class="media-body">
                    <form action="{{route('reply.store', $comment_i->id)}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="reply_content" type="text" class="form-control" placeholder="Reply">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Reply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($comment_i->GetCommentReplies as $reply_i)
                <!-- Reply -->
                <div class="media mt-4">
                    <img class="d-flex mr-3 rounded-circle" width="35px" src="{{$reply_i->usersBT->profile_pic}}" alt="">
                    <div class="media-body">
                      <h5 class="mt-0">{{$reply_i->usersBT->name}}</h5>
                      {{$reply_i->reply_content}}
                    </div>
                </div>
            @endforeach
            </div>
          </div>
        @endforeach

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection

</x-admin-master>