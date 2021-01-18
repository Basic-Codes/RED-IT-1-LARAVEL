<x-admin-master>

@section('content')

    <h1 class="my-4 text-bold">
        <div class="sidebar-brand-text mx-3"><small>Welcome to <b>Red-IT <sup>1</sup></b> </small></div>
    </h1>
    <li class="m-0">This website is not mobile friendly. Try using Desktop</li>
    <li class="m-0">You will automatically be an admin by default so you can visit every route properly</li>
    <br>
    @if (Session::has('deleted-msg'))
        <div class="alert alert-danger">{{session('deleted-msg')}}</div>
    @elseif(Session::has('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    <style>
        /* +-----------------------------------------+ */
        /* |                Image Crop               | */
        /* +-----------------------------------------+ */
        .frame-square {
            width: 100%;
            padding-top: 40%;
            overflow: hidden;
            position: relative;
        }

        .frame-square img {
            width: 100%;
            height: auto;
            margin: auto;
            position: absolute;
            top: -100%;
            right: -100%;
            bottom: -100%;
            left: -100%;
        }
    </style>

    @foreach ($posts as $post_i)
        <div class="card mb-4">
            <div class="frame-square">
                <img class="card-img-top" src="{{$post_i->post_image}}" alt="Card image cap">
            </div>
            <div class="card-body">
            <h2 class="card-title">{{$post_i->title}}</h2>
            {{-- <p class="card-text">{!!Str::limit($post_i->content, '50', '...')!!}</p> --}}
            <a href="{{route('post.show', $post_i->id)}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
            Posted {{$post_i->created_at->diffForHumans()}}
            by <a href="{{route('user.profile', $post_i->userBT->id)}}">{{$post_i->userBT->name}}</a>
            </div>
        </div>        
    @endforeach

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
        <a class="page-link" href="#">&larr; Older</a>
        </li>
        <li class="page-item disabled">
        <a class="page-link" href="#">Newer &rarr;</a>
        </li>
    </ul>

@endsection

</x-admin-master>