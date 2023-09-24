{{-- Page Name:admin sidebar menu
Developed on :2023/03/24
Updated on :2023/03/24
Objective : this page will lists all the amdin users
--}}
<aside class="main-sidebar  elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard')}}" class="brand-link" style="border-bottom: 1px solid #f7c646;">
      Elo Sports
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid #e5e7ec;">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
          <i class="nav-icon fas fa-home"></i>
        </div>
        <div class="info">
          <a href="{{ url('/dashboard')}}" class="d-block">Dashboard</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           @if(auth()->user()->can('view-live-streaming'))
          <li class="nav-item    {{ (request()->segment(1) == 'livestreams') ? 'menu-is-opening menu-open' : '' }} ">
            <a href="#" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                Livestreams
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li  class="nav-item {{ (request()->segment(2) == 'in-progress') ? 'active' :'' }}">
                <a href="{{url('livestreams/in-progress')}}" class="nav-link ">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>In Progress</p>
                </a>
              </li>
              <li class="nav-item {{ (request()->segment(2) == 'complete') ? 'active' :'' }}">
                <a href="{{url('livestreams/completed')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                    <p>Completed </p>
                </a>
              </li>
            </ul>
          </li>

          @endif
           @if(auth()->user()->can('view-account'))
          <li class="nav-item    {{ (request()->segment(1) == 'users' ||  request()->segment(1) == 'roles' || request()->segment(1) == 'admin-lists') ? 'menu-is-opening menu-open' : '' }} ">
            <a href="#" class="nav-link ">

              <p>
                User Account Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               @if(auth()->user()->can('view-user'))
              <li  class="nav-item {{ (request()->segment(1) == 'users') ? 'active' :'' }}">
                <a href="{{url('/users')}}" class="nav-link ">
                  <p>Users</p>
                </a>
              </li>
               <li  class="nav-item {{ (request()->segment(1) == 'admin-lists') ? 'active' :'' }}">
                <a href="{{url('/admin-lists')}}" class="nav-link ">
                  <p>Admin Lists</p>
                </a>
              </li>
              @endif
               @if(auth()->user()->can('view-role'))
              <li class="nav-item {{ (request()->segment(1) == 'roles') ? 'active' :'' }}">
                <a href="{{url('/roles')}}" class="nav-link">
                    <p>Roles</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
           @if(auth()->user()->can('view-spam'))
          <li class="nav-item    {{ (request()->segment(1) == 'filter-word-lists') ? 'active' : '' }} ">
            <a href="{{url('filter-word-lists')}}" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
            <p>
                            Filter Words
                          </p>
            </a>

          </li>
          @endif
           @if(auth()->user()->can('create-setting'))
		   <li class="nav-item    {{ (request()->segment(1) == 'setting') ? 'active' : '' }} ">

           <a href="{{url('setting')}}" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                Setting
              </p>
            </a>

          </li>
			    @endif
			 @if(auth()->user()->can('view-betting-master'))
			 <li class="nav-item    {{ (request()->segment(1) == 'betting') ? 'menu-is-opening menu-open' : '' }} ">
            <a href="#" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                Betting Amount Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->can('create-betting-master'))
              <li  class="nav-item {{  (request()->segment(1) == 'betting') && (request()->segment(2) == 'add') ? 'active' :'' }}">
                <a href="{{url('betting/add')}}" class="nav-link ">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Add New</p>
                </a>
              </li>
              @endif
               @if(auth()->user()->can('view-betting-master'))
              <li class="nav-item {{ (request()->segment(1) == 'betting') && (request()->segment(2) == 'list') ? 'active' :'' }}">
                <a href="{{url('betting/list')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                    <p>List </p>
                </a>
              </li>
              @endif
            </ul>
          </li>



     @endif
    @if(auth()->user()->can('view-betting-view-master'))
      <li class="nav-item    {{ (request()->segment(1) == 'bettingview')  ? 'menu-is-opening menu-open' : '' }} ">
            <a href="#" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                Betting View Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             @if(auth()->user()->can('create-betting-view-master'))
              <li  class="nav-item {{ (request()->segment(1) == 'bettingview') && (request()->segment(2) == 'add') ? 'active' :'' }}">
                <a href="{{url('bettingview/add')}}" class="nav-link ">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Add New</p>
                </a>
              </li>
              @endif
               @if(auth()->user()->can('view-betting-view-master'))
              <li class="nav-item {{ (request()->segment(1) == 'bettingview') && (request()->segment(2) == 'list') ? 'active' :'' }}">
                <a href="{{url('bettingview/list')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                    <p>List </p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('view-betting-view-master'))
      <li class="nav-item    {{ (request()->segment(1) == 'streaming-report')  || (request()->segment(1) == 'twitch-report')  ? 'menu-is-opening menu-open' : '' }} ">
            <a href="#" class="nav-link ">
              {{-- <i class="far fa-circle nav-icon"></i> --}}
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             @if(auth()->user()->can('create-betting-view-master'))
              <li  class="nav-item {{ (request()->segment(1)  == 'streaming-report') ? 'active' :'' }}">
                <a href="{{url('streaming-report')}}" class="nav-link ">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Streaming Report</p>
                </a>
              </li>
              @endif
               @if(auth()->user()->can('view-streams-reports'))
              <li class="nav-item {{ (request()->segment(1) == 'twitch-report') ? 'active' :'' }}">
                <a href="{{url('twitch-report')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                    <p>Twitch Report </p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
