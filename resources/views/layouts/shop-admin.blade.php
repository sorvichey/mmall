<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SHOP-ADMIN</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/bootstrap.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/font-awesome.min.css')}}" media="all" />
        <!-- <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/animate.min.css')}}" media="all" /> -->
        <!-- <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/font-electro.css')}}" media="all" /> -->
        <!-- <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/owl-carousel.css')}}" media="all" /> -->
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/style.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/colors/black.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('bootstrap-datepicker/css/bootstrap-datepicker.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('datepicker/daterangepicker.css')}}" media="all" />
  <!-- Custom styles for this template-->
  <link href="{{asset('shop-admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <style>
    .btn-xs{
      padding: 0px 6px !important;
    }
  </style>

</head>

<body id="page-top">
<a href="#" class="scrollToTop" style="display: none;"><i class="fa fa-arrow-up"></i></a>
    <div id="page" class="hfeed site">
        <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
        <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
        <div class="top-bar hidden-md-down">
            <div class="container">
                <nav>
                    <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                        <li class="menu-item animate-dropdown"><a title="Buy Protection" href="{{url('/page/1')}}">{{trans("labels.buyer_projection")}}</a></li>
                    </ul>
                </nav>
                <nav>
                    <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                        <li class="menu-item animate-dropdown"><a title="Store Locator" href="{{url('/career')}}"><i class="ec ec-list-view"></i>Career</a></li>
                        <li class="menu-item animate-dropdown"><a title="Track Your Order" href="track-your-order.html"><i class="ec ec-transport"></i>Track Your Order</a></li>
                        <li class="menu-item animate-dropdown"><a title="Shop" href="{{url('owner/login')}}"><i class="ec ec-shopping-bag"></i>{{trans("labels.shop")}}</a></li>
                    
                        <li class="menu-item animate-dropdown">
                            <a href="#" onclick="chLang(event,'en')">
                                <img src="{{asset('uploads/flags/en.png')}}" alt="" width="25" style="margin-right: 5px;">
                                </a>
                            <a href="#" onclick="chLang(event,'km')">
                                <img src="{{asset('uploads/flags/kh.png')}}" alt="" width="26">
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div><!-- /.top-bar -->
    </header><!-- #masthead -->



  <!-- Shop Admin -->
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">M-Mall</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/owner/home')}}">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('owner/my-product')}}">
          <i class="fa fa-product-hunt"></i>
          <span>Products</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('owner/product/order')}}">
          <i class="fa fa-shopping-cart"></i>
          <span>Product Order</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('owner/product/promotion')}}">
          <i class="fa fa-tag"></i>
          <span>Promotions</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('owner/product/out-stock')}}">
          <i class="fa fa-times-circle"></i>
          <span>Product Out of Stock</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('owner/my-shop')}}">
          <i class="fa fa-bank"></i>
          <span>My Shop</span></a>
      </li>




      <!-- Divider -->
      <!-- <hr class="sidebar-divider d-none d-md-block"> -->

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fa fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fa fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fa fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Rithy SAM</span>
                <img class="img-profile rounded-circle" src="">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('owner/logout')}}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @yield('content')
        </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; M-Mall 2018-2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{url('owner/logout')}}">Logout</a>
        </div>
      </div>
    </div>
  </div> -->
<!-- end shop admin -->

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('shop-admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('shop-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('shop-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('shop-admin/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <!-- <script src="{{asset('shop-admin/vendor/chart.js/Chart.min.js')}}"></script> -->

  <!-- Page level custom scripts -->
  <!-- <script src="{{asset('shop-admin/js/demo/chart-area-demo.js')}}"></script> -->
  <!-- <script src="{{asset('shop-admin/js/demo/chart-pie-demo.js')}}"></script> -->

          <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/jquery.min.js')}}"></script> -->
        <script type="text/javascript" src="{{asset('fronts/assets/js/tether.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('fronts/assets/js/bootstrap.min.js')}}"></script>
        <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('fronts/assets/js/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('fronts/assets/js/echo.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('fronts/assets/js/wow.min.js')}}"></script> -->
        <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/jquery.easing.min.js')}}"></script> -->
        <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/jquery.waypoints.min.js')}}"></script> -->
        <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/electro.js')}}"></script> -->
        <!-- <script type="text/javascript" src="{{asset('fronts/assets/js/jquery-3-3-1.min.js')}}"></script> -->
        <script type="text/javascript" src="{{asset('datepicker/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('datepicker/daterangepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script>
			function chLang(evt, ln)
			{
				evt.preventDefault();
				jQuery.ajax({
					type: "GET",
					url: "{{url('/')}}" + "/language/" + ln,
					success: function(sms){
						if(sms>0)
						{
							location.reload();
						}
					}
				});
			}
		</script>
 @yield('js')

</body>

</html>
