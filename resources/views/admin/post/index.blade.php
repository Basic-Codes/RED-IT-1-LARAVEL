<x-admin-master>
@section('content')
    
    @if (Session::has('deleted-msg'))
        <div class="alert alert-danger">{{session('deleted-msg')}}</div>
    @elseif(Session::has('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    <!-- Begin Page Content -->
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Title</th>
                <th><i class="fas fa-arrow-circle-up"></i></th>
                  <th><i class="fas fa-arrow-circle-down"></i></th>
                <th>Created</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Title</th>
                <th><i class="fas fa-arrow-circle-up"></i></th>
                <th><i class="fas fa-arrow-circle-down"></i></th>
                <th>Created</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </tfoot>
            <tbody>
                
              @foreach ($posts as $post_i)
                <tr>
                    <td>{{$post_i->id}}</td>
                    <td>{{$post_i->userBT->name}}</td>
                    <td><a href="{{route('post.show', $post_i->id)}}">{{$post_i->title}}</a></td>
                    <td>{{count($post_i->votesHM()->where("vote_type", "up")->get())}}</td>
                    <td>{{count($post_i->votesHM()->where("vote_type", "down")->get())}}</td>
                    <td>{{$post_i->created_at->diffForHumans()}}</td>
                    <td><img src="{{$post_i->post_image}}" alt=""  width="75px"></td>
                    
                    {{-- @can('view', $post_i) --}}
                    <td><a href="{{route('post.edit', $post_i->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{route('post.destroy', $post_i->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    {{-- @endcan --}}

                </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
    </div>

@endsection

@section('table_script')

        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
</x-admin-master>
