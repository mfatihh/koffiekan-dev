<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Koffiekan
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <link href="{{ asset('css/assets/material-dashboard.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/assets/demo/demo.css') }}" rel="stylesheet" />
  <link href="{{asset('css/font.googleapis.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
  <style>
    .alert {
      padding: 20px!important;
      background-color: #f44336!important;
      color: white!important;
      opacity: 1!important;
      transition: opacity 0.6s!important;
      margin-bottom: 15px!important;
    }
    
    .alert.success {background-color: #4CAF50!important;}
    .alert.info {background-color: #2196F3;}
    .alert.warning {background-color: #ff9800;}
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
    }
    </style>
    @yield('css')
</head>

<body>
  <div class="wrapper">
    <div class="sidebar" class="sidebar" data-color="purple" data-background-color="white" >
      <div class="logo">
        <a class="simple-text logo-normal">
          Koffiekan
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('/') || Request::is('dashboard') ? 'active' : ''}}">
            <a class="nav-link " href="{{url('/dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          @if(Auth::user()->hasRole('superadmin'))
          <li class="nav-item {{Request::is('user') || Request::is('user/*') ? 'active' : ''}}">
            <a class="nav-link nav-toggle" href="{{route('user.index')}}">
              <i class="material-icons">face</i>
              <p>Users</p>
            </a>
          </li>
          @endif
          </li>
          <li class="nav-item {{Request::is('transactions') || Request::is('drafts/*') ||Request::is('transactions/*') ? 'active' : ''}}">
            <a class="nav-link nav-toggle" href="{{route('transactions.index')}}">
              <i class="material-icons">content_paste</i>
              <p>Transaction</p>
            </a>
          </li>

          <li class="nav-item {{Request::is('products')||Request::is('product/edit/*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('products.index')}}">
              <i class="material-icons">library_books</i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('ingredient') ? 'active' : ''}}">
            <a class="nav-link" href="{{url('ingredient')}}">
              <i class="material-icons">bubble_chart</i>
              <p>Ingridient</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('reports/*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('reports.sales.index')}}">
              <i class="material-icons">all_inbox</i>
              <p>Report Sales</p>
            </a>
          </li>
          <li class="nav-item  {{Request::is('stok/kartu') ? 'active' : ''}}">
            <a class="nav-link nav-toggle" href="{{url('stok/kartu')}}">
              <i class="material-icons">credit_card</i>
              <p>Report Stock</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Layout Samping Kiri -->

    <div class="main-panel" style="padding-top:50px;">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            {{-- <a class="navbar-brand" href="#pablo">Dashboard</a> --}}
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  {{-- <a class="dropdown-item" href="#">Profile</a>
                          <a class="dropdown-item" href="#">Settings</a> --}}
                  {{-- <div class="dropdown-divider"></div> --}}
                  {{-- <a class="dropdown-item" href="#">Log out</a> --}}
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{csrf_field()}}
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="">
        <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="">
            <div class="portlet-body">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/assets/core/jquery.min.js')}}"></script>
  <script src="{{ asset('js/assets/core/popper.min.js')}}"></script>
  <script src="{{ asset('js/assets/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/moment.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/sweetalert2.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/jquery.bootstrap-wizard.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/bootstrap-selectpicker.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/bootstrap-datetimepicker.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/bootstrap-tagsinput.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/jasny-bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/jquery-jvectormap.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/nouislider.min.js')}}"></script>
  <script src="{{ asset('vendor/jquery/core.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/arrive.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/chartist.min.js')}}"></script>
  <script src="{{ asset('js/assets/plugins/bootstrap-notify.js')}}"></script>
  <script src="{{ asset('js/assets/material-dashboard.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/assets/demo.js')}}"></script>
  <script src="{{ asset('js/layout.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/assets/plugins/moment.min.js')}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('vendor/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
  @yield('script')
</body>

</html>