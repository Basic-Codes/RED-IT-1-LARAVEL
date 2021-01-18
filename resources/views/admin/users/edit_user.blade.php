<x-admin-master>
    @section('content')
        
        @if (Session::has('deleted-msg'))
            <div class="alert alert-danger">{{session('deleted-msg')}}</div>
        @endif
    
        <!-- Begin Page Content -->
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit {{$user->name}}'s role</h1>
    
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
                    <th><i class="fas fa-circle"></i></th>
                    <th>id</th>
                    <th>Role</th>
                    <th>Attach</th>
                    <th>Dettach</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th><i class="fas fa-circle"></i></th>
                    <th>id</th>
                    <th>Role</th>
                    <th>Attach</th>
                    <th>Dettach</th>
                  </tr>
                </tfoot>
                <tbody>
                
                  @foreach ($roles as $role_i)
                    <tr>
                        @if ($user->rolesBTM->contains($role_i))
                          <td style="color:limegreen;"><i class="fas fa-check"></i></td>
                        @else
                          <td style="color:#4C71DD;"><i class="far fa-circle"></i></td>
                        @endif>
                        
                        <td>{{$role_i->id}}</td>
                        <td>{{$role_i->name}}</td>
                        <td>
                            <form action="{{route('user.role.attach', [$user, $role_i])}}" method="POST">
                                @csrf
                                <button class="btn btn-primary"
                                  @if ($user->rolesBTM->contains($role_i))
                                    disabled
                                  @endif>
                                  Attach
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('user.role.detach', [$user, $role_i])}}" method="POST">
                                @csrf
                                <button class="btn btn-danger"
                                @if (!$user->rolesBTM->contains($role_i))
                                  disabled
                                @endif>
                                Detach
                              </button>
                            </form>
                        </td>
    
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
    