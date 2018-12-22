<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tracking Management | M-Mall</title>
    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('chosen/docsupport/prism.css')}}" rel="stylesheet">
    <link href="{{asset('chosen/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('chosen/chosen.css')}}">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/table.css")}}">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">M-Mall</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}"> <i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/product-management')}}"> <i class="fa fa-product-hunt"></i> Products  </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/customer-management')}}"> <i class="fa fa-users"></i> Customer</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/admin/career-management')}}"><i class="fa fa-university"></i> Career</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/admin/tracking-management')}}"> <i class="fa fa-plane"></i> Tracking  <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/setting')}}"> <i class="fa fa-cogs"></i> Settings</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{Auth::user()->username}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav1">
                    <a class="dropdown-item" href="#"><i class="fa fa-user text-primary"></i> &nbsp;Profile</a>
                    <a href="{{url('/user/update-password/'.Auth::user()->id)}}" class="dropdown-item"><i class="fa fa-key text-warning"></i> &nbsp;Reset Password</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out text-success"></i> &nbsp;Logout</a>
                </div>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
            <ul class="nav nav-pills flex-column" id="siderbar">
                <li class="nav-item"><strong><i class="fa fa-cogs"></i> Management</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/tracking')}}" id="menu_tracking">Tracking</a>
                </li>
                <li class="nav-item"><strong><i class="fa fa-cogs"></i> Setting</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/tracking-origin')}}" id="menu_origin">Origin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/tracking-destination')}}" id="menu_destination">Destination</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/tracking-status')}}" id="menu_status">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/tracking-location')}}" id="menu_location">Location</a>
                </li>
            </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
            @yield('content')
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('chosen/docsupport/prism.js')}}"></script>
<script src="{{asset('chosen/docsupport/init.js')}}"></script>
@yield('js')
</body>
</html>
