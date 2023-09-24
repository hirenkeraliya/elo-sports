<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elo Sports | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('vendor-assets/css/font-awesome-all.min.css')}}">
  <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('vendor-assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor-assets/css/daterangepicker.css')}}">
      <link rel="stylesheet" href="{{asset('vendor-assets/css/select2.min.css')}}">

       <link rel="stylesheet" href="{{asset('vendor-assets/css/select2-bootstrap-4.min.css')}}">
            <link rel="stylesheet" href="{{asset('vendor-assets/css/select2-bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('vendor-assets/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('vendor-assets/css/responsive.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('vendor-assets/css/buttons.bootstrap4.min.css')}}">

  <style>

.brand-link,
.brand-link:hover{
    color:#111827;
}
.user-panel .info {
    display: inline-block;
    padding: 0px 5px 5px 10px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #474d58;
     background-color: transparent;
}
.nav-item.active {
    background:#f49e3f;
    color:#ffffff;
    border-radius:5px;
}
.nav-item .active .nav-link p{
   color: white;
}
.nav-sidebar .menu-open>.nav-treeview {
    display: block;
    margin-left: 9px;
}
  </style>
    @yield('css')
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
      @if(request()->segment(1) != 'chat-lists')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('/')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('logout')}}" class="nav-link">Logout</a>
      </li>

      @endif
    </ul>
  </nav>


  @include('layout.admin.sidebar')

  @yield('content')



  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="{{route('/')}}">Elo Sports.</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('vendor-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/sweetalert2.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendor-assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendor-assets/js/moment.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/adminlte.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/daterangepicker.js')}}"></script>
<script src="{{asset('vendor-assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendor-assets/js/select2.full.min.js')}}"></script>


<script type="text/javascript">
var baseUrl = "{{url('/')}}"
</script>
@yield('js')
</body>
</html>
