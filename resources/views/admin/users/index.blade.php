<x-admin-master>
    @section('content')
        
        @if (Session::has('deleted-msg'))
            <div class="alert alert-danger">{{session('deleted-msg')}}</div>
        @endif
    
        <!-- Begin Page Content -->
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Joined</th>
                    <th>Edit Role</th>
                    <th>Delete User</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Joined</th>
                    <th>Edit Role</th>
                    <th>Delete User</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                  @foreach ($users as $user_i)
                    <tr>
                        <td>{{$user_i->id}}</td>
                        <td>
                            <img src="{{$user_i->profile_pic}}" width="45px" class="rounded-circle" alt="">
                        </td>
                        <td><a href="{{route('user.profile', $user_i)}}">{{$user_i->name}}</a></td>
                        <td>{{$user_i->created_at->diffForHumans()}}</td>
                        
                        {{-- @can('view', $user_i) --}}
                        <td><a href="{{route('user.role.edit', $user_i->id)}}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{route('user.destroy', $user_i->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (Auth::user()->id == $user_i->id)
                                    <button class="btn btn-danger">Delete Own Account</button>
                                @else
                                    <button class="btn btn-danger">Delete</button>
                                @endif
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
    