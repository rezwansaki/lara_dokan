<!-- 
  Project Name: 'Dokan' 
  Project Version: 1.0.0
  Start Date: 22-Dec-2020
  Description: This is our practice project of Laravel 8 and also a simple shop management system. 
  Developed by: Md. Rezwan Saki Alin
  Used Tools: Laravel 8, Bootstrap free admin template 'AdminLTE 3.0.5' 
 -->
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Dokan | Laravel Project</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/contactus')}}" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-2 sm:block">
              @auth
              <a href="{{ url('/user/profile') }}" class="nav-link text-sm text-gray-700 underline">
                <i class="fas fa-user mr-3"></i>
                Profile
              </a>
              <a href="{{ url('/dashboard') }}" class="nav-link text-sm text-gray-700 underline">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
              </a>
              <div class="dropdown-divider"></div>
              <!-- Logout -->
              <a href="{{ route('logout') }}" class="nav-link text-sm text-gray-700 underline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              <!-- End of Logout -->
              @else

              <a href="{{ route('login') }}" class="nav-link text-sm text-gray-700 underline">
                <i class="fas fa-sign-in-alt mr-3"></i>
                Login
              </a>

              <div class="dropdown-divider"></div>
              @if (Route::has('register'))
              <a href="{{ route('register') }}" class="nav-link text-sm text-gray-700 underline">
                <i class="fas fa-user-edit mr-3"></i>
                Register
              </a>
              @endif
              @endauth
            </div>
            @endif
          </div>

        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('adminlte')}}/dist/img/logo_dokan.png" alt="AdminLTE Logo" class="rounded-full w-1 h-1">
        <span class="brand-text font-weight-light ml-1">Dokan</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (Auth::check())
            <img src="{{asset('adminlte')}}/dist/img/avatar_male.png" class="img-circle img-bordered-sm elevation-2" alt="User Image">
            @else
            <img src="{{asset('adminlte')}}/dist/img/avator_guest.jpg" class="img-circle img-bordered-sm elevation-2" alt="User Image">
            @endif
          </div>
          <div class="info">
            @if (Auth::check())
            <!-- <a href="#" class="d-block">Alexander Pierce</a> -->
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            <a href="#" class="d-block text-sm">User ID: {{ Auth::user()->id }}</a>
            @foreach(Auth::user()->getRoleNames() as $userrole)
            @if($userrole == 'superadmin')
            <span class="right badge badge-pill badge-danger">
              {{ $userrole }}
            </span>
            @endif
            @if($userrole == 'admin')
            <span class="right badge badge-pill badge-warning">
              {{ $userrole }}
            </span>
            @endif
            @if($userrole == 'editor')
            <span class="right badge badge-pill badge-primary">
              {{ $userrole }}
            </span>
            @endif
            @if($userrole == 'salesman')
            <span class="right badge badge-pill badge-info">
              {{ $userrole }}
            </span>
            @endif
            @if($userrole == 'member')
            <span class="right badge badge-pill badge-success">
              {{ $userrole }}
            </span>
            @endif
            @endforeach
            @else
            <a class="d-block">Guest</a>
            @endif
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!-- User Navigation -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview text-sm">
                <li class="nav-item">
                  <a href="{{url('users')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-users"></i>
                    <p>All Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('usercreate')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Create User</p>
                  </a>
                </li>
                <hr>
                <!-- Employee -->
                <li class="nav-item">
                  <a href="{{url('/user/allemployees')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>All Employees</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('user/employee/create')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Create Employee</p>
                  </a>
                </li>
                <hr>
                <!-- Customer -->
                <li class="nav-item">
                  <a href="{{url('user/customer')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>Customer</p>
                  </a>
                </li>
                <hr>
              </ul>
            </li>
            <!-- /user navigation -->
            <!-- Salary Navigation -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Salary
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview text-sm">
                <li class="nav-item">
                  <a href="{{url('/employee/salarydetails')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Salary Details</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/employee/salary')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Salary Provide</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/employee/salarydue')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Salary Due</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/employee/salaryadvance')}}" class="nav-link pl-4">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Advance Salary</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- /Salary navigation -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Thanks to AdminLTE <small>(Bootstrap Admin Template)</small>
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2020 Dokan</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('adminlte')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte')}}/dist/js/adminlte.min.js"></script>

  <!-- Toaster Message -->
  <!-- Toaster Offline -->
  <link rel="stylesheet" href="{{asset('toaster')}}/toastr.min.css">
  <script src="{{asset('toaster')}}/toastr.min.js"></script>
  <!-- Toaster CDN -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" /> -->

  @if(Session::has('message'))
  <script>
    // toastr.options = {
    //   "closeButton": false,
    //   "debug": false,
    //   "newestOnTop": false,
    //   "progressBar": false,
    //   "positionClass": "toast-top-right",
    //   "preventDuplicates": false,
    //   "onclick": null,
    //   "showDuration": "300",
    //   "hideDuration": "1000",
    //   "timeOut": "5000",
    //   "extendedTimeOut": "1000",
    //   "showEasing": "swing",
    //   "hideEasing": "linear",
    //   "showMethod": "fadeIn",
    //   "hideMethod": "fadeOut"
    // }

    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;

      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;

      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;

      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
    }
    //location.reload(); //clear flash message 
  </script>
  @endif
  <!-- /Toaster Message -->

  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{asset('sweetalert')}}/sweetalert2.min.css">
  <script src="{{asset('sweetalert')}}/sweetalert2.all.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.css"> -->
  <script>
    $(document).on("click", "#delete", function(e) {
      e.preventDefault();
      var link = $(this).attr("href");
      Swal.fire({
          title: 'Are you sure?',
          text: "Are you sure, you want to delete this data?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
          if (result.value) {
            window.location.href = link;
          } else {
            swal.fire("Safe Data!");
          }
        });
    });
  </script>
  <!-- /Sweet Alert -->

  <!-- Nav link highlight after click -->
  <script>
    $(document).ready(function() {
      $('a[href$="' + location.pathname + '"]').addClass('active');
    });
  </script>
  <!-- /Nav link highlight after click -->
</body>

</html>