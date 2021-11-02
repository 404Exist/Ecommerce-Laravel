  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    @include('admin.layouts.menu')

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('assets/adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('assets/adminlte/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('assets/adminlte/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- Languages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-globe"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{__('admin.languages')}}</span>
          <div class="dropdown-divider"></div>
          <a href="/lang/ar" class="dropdown-item">
            <i class="fa fa-flag mr-2"></i> {{__('admin.arabic')}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="/lang/en" class="dropdown-item">
            <i class="fa fa-flag mr-2"></i> {{__('admin.english')}}
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('assets/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(admin_auth()->user()->name) }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{admin_url()}}" class="nav-link {{ request()->url() == admin_url() ? active_menu('admin', 1)[1] : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('admin.dashboard') }}
              <span class="right badge badge-danger">New</span>
            </p>
            </a>
          </li>

          @can('Show Role')
            <li class="nav-item">
                <a href="{{admin_url('roles')}}" class="nav-link {{ active_menu('roles', 2)[1] }}">
                    <i class="fas fa-gavel"></i>
                    <p> Roles <span class="right badge badge-danger">New</span></p>
                </a>
            </li>
          @endcan


          <li class="nav-item {{ active_menu('accounts', 2)[0] }}">
            <a href="#" class="nav-link {{ active_menu('users', 3)[1] }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @can('Show Admin Account')
                <li class="nav-item">
                    <a href="{{admin_url('accounts/admins')}}" class="nav-link {{ active_menu('admins', 3)[1] }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Admins</p>
                    </a>
                </li>
                @endcan
                @can('Show User Account')
                <li class="nav-item {{ active_menu('users', 3)[0] }}">
                    <a href="#" class="nav-link {{ active_menu('users', 3)[1] }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{admin_url('accounts/users')}}" class="nav-link {{ active_menu('users', 3)[1] }}">
                        <i class="far fa-users nav-icon"></i>
                        <p>All Levels</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{admin_url('accounts/users')}}?level=user" class="nav-link {{ active_menu('userss', 3)[1] }}">
                        <i class="far fa-users nav-icon"></i>
                        <p>Users</p>
                        </a>
                        <a href="{{admin_url('accounts/users')}}?level=vendor" class="nav-link {{ active_menu('userss', 3)[1] }}">
                        <i class="far fa-users nav-icon"></i>
                        <p>Vendors</p>
                        </a>
                        <a href="{{admin_url('accounts/users')}}?level=company" class="nav-link {{ active_menu('userss', 3)[1] }}">
                        <i class="far fa-users nav-icon"></i>
                        <p>Companies</p>
                        </a>
                    </li>
                    </ul>

                </li>
                @endcan
            </ul>
          </li>

          @can('Show Website Settings')
            <li class="nav-item">
                <a href="{{admin_url('settings')}}" class="nav-link {{ active_menu('settings', 2)[1] }}">
                    <i class="fas fa-sliders-h"></i>
                <p>
                Website settings
                <span class="right badge badge-danger">New</span>
                </p>
                </a>
            </li>
          @endcan

          @can('Show Countries')
            <li class="nav-item {{ active_menu('countries', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('countries', 3)[1] }}">
                <i class="fa fa-flag"></i>
                <p>
                    Countries
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('countries')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('countries', 2)[1] }}">
                    <i class="fa fa-flag nav-icon"></i>
                    <p>Countries</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('countries/create')}}" class="nav-link {{ active_menu('countries', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>Add Countries</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Cities')
            <li class="nav-item {{ active_menu('cities', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('cities', 3)[1] }}">
                <i class="fa fa-flag"></i>
                <p>
                    Cities
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('cities')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('cities', 2)[1] }}">
                    <i class="fa fa-flag nav-icon"></i>
                    <p>Cities</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('cities/create')}}" class="nav-link {{ active_menu('cities', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>Add Cities</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show States')
            <li class="nav-item {{ active_menu('states', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('states', 3)[1] }}">
                <i class="fa fa-flag"></i>
                <p>
                    States
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('states')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('states', 2)[1] }}">
                    <i class="fa fa-flag nav-icon"></i>
                    <p>States</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('states/create')}}" class="nav-link {{ active_menu('states', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>Add States</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Departments')
            <li class="nav-item {{ active_menu('departments', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('departments', 3)[1] }}">
                <i class="fa fa-list"></i>
                <p>
                    Departments
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('departments')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('departments', 2)[1] }}">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Departments</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('departments/create')}}" class="nav-link {{ active_menu('departments', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>Add Department</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Trademarks')
            <li class="nav-item {{ active_menu('trademarks', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('trademarks', 3)[1] }}">
                <i class="fa fa-cube"></i>
                <p>
                    Trademarks
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('trademarks')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('trademarks', 2)[1] }}">
                    <i class="fa fa-cube nav-icon"></i>
                    <p>Trademarks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('trademarks/create')}}" class="nav-link {{ active_menu('trademarks', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Trademark</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Manufacturers')
            <li class="nav-item {{ active_menu('manufacturers', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('manufacturers', 3)[1] }}">
                <i class="fa fa-cube"></i>
                <p>
                    Manufacturers
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('manufacturers')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('manufacturers', 2)[1] }}">
                    <i class="fa fa-cube nav-icon"></i>
                    <p>Manufacturers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('manufacturers/create')}}" class="nav-link {{ active_menu('manufacturers', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Manufacturer</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Shipping Companies')
            <li class="nav-item {{ active_menu('shippings', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('shippings', 3)[1] }}">
                <i class="fas fa-shipping-fast"></i>
                <p>
                    Shipping Companies
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('shippings')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('shippings', 2)[1] }}">
                    <i class="fas fa-shipping-fast nav-icon"></i>
                    <p>Shipping Companies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('shippings/create')}}" class="nav-link {{ active_menu('shippings', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Shipping Company</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Malls')
            <li class="nav-item {{ active_menu('malls', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('malls', 3)[1] }}">
                <i class="fa fa-building"></i>
                <p>
                    Malls
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('malls')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('malls', 2)[1] }}">
                    <i class="fa fa-building nav-icon"></i>
                    <p>Malls</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('malls/create')}}" class="nav-link {{ active_menu('malls', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Mall</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Colors')
            <li class="nav-item {{ active_menu('colors', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('colors', 3)[1] }}">
                <i class="fa fa-paint-brush"></i>
                <p>
                    Colors
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('colors')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('colors', 2)[1] }}">
                    <i class="fa fa-paint-brush nav-icon"></i>
                    <p>Colors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('colors/create')}}" class="nav-link {{ active_menu('colors', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Color</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Sizes')
            <li class="nav-item {{ active_menu('sizes', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('sizes', 3)[1] }}">
                <i class="fa fa-info-circle"></i>
                <p>
                    Sizes
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('sizes')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('sizes', 2)[1] }}">
                    <i class="fa fa-info-circle nav-icon"></i>
                    <p>Sizes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('sizes/create')}}" class="nav-link {{ active_menu('sizes', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Size</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Weights')
            <li class="nav-item {{ active_menu('weights', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('weights', 3)[1] }}">
                <i class="fa fa-weight-hanging"></i>
                <p>
                    Weights
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('weights')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('weights', 2)[1] }}">
                    <i class="fa fa-weight-hanging nav-icon"></i>
                    <p>Weights</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('weights/create')}}" class="nav-link {{ active_menu('weights', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Weight</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

          @can('Show Products')
            <li class="nav-item {{ active_menu('products', 2)[0] }}">
                <a href="#" class="nav-link {{ active_menu('products', 3)[1] }}">
                <i class="fa fa-tag"></i>
                <p>
                    Products
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{admin_url('products')}}" class="nav-link {{ active_menu('create', 3)[1] ? '' : active_menu('products', 2)[1] }}">
                    <i class="fa fa-tag nav-icon"></i>
                    <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{admin_url('products/create')}}" class="nav-link {{ active_menu('products', 2)[1] ? active_menu('create', 3)[1] : '' }}">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>New Product</p>
                    </a>
                </li>
                </ul>
            </li>
          @endcan

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
