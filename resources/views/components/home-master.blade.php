<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin-X</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/app.css')}}" rel="stylesheet">

  <!-- Fontawesome -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
    <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">

</head>

<body class="pt-0">

  <!-- Navigation -->
  {{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: #4E73DF">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">Admin-X</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>    
          @endif

          @auth
            <x-nav-profile-options class="blade"></x-nav-profile-options>
          @endauth
        
        </ul>
      </div>
    </div>
  </nav> --}}
  <x-nav></x-nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

            @yield('content')

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <a class="btn btn-secondary btn-block text-light" href="{{route('home')}}">Home</a>

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="This does nothing...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Admins</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Law</a>
                  </li>
                  <li>
                    <a href="#">Luffy</a>
                  </li>
                  <li>
                    <a href="#">John Cena</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Random</a>
                  </li>
                  <li>
                    <a href="#">Red</a>
                  </li>
                  <li>
                    <a href="#">Sad</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Welcome to One Red-it</h5>
          <div class="card-body">
            Here you can create post based on whatever you like. 
            According to your popularity, you may even be promoted to moderator or admin.
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
