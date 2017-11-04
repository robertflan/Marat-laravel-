<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/webcss/site-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/webcss/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlslider/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlslider/owl-carousel/owl.template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/webcss/select2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/webcss/select2-bootstrap.css') }}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="app">
    <div id="loadessr"><div id="loader"></div></div>
    <div id="header" class="container-fluid @yield('header-class', 'pages')">
        <div class="row">
            @yield('header-banner')
            <div class="top_header">
                <nav class="navbar navbar-fixed-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo2.png') }}" alt="{{ config('app.name', 'Laravel') }}" /></a>
                        </div>
                        <div class="logins">
                            <a href="{{ url('/application') }}" class="post_job"><span class="label job-type partytime">Bewerbung einreichen</span></a>
                            @if(Auth::guest())
                            <div class="dropdown">
                                <a href="{{ url('/register') }}" class="login"><i class="fa fa-user"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                </ul>
                            </div>
                            @else
                            <div class="dropdown">
                                <a href="{{ url('/my/profile') }}" class="login"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/my/profile') }}">My profile</a></li>
                                    <li><a href="{{ url('/my/change_password') }}">Change Password</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </div>
                            @endif
                        </div>
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                @if(!Auth::guest())
                                <li class="mobile-menu"><a href="{{ url('/my/profile') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                                <li class="mobile-menu"><a href="{{ url('/my/profile') }}">My profile</a></li>
                                <li class="mobile-menu"><a href="{{ url('/my/change_password') }}">Change Password</a></li>
                                <li class="mobile-menu"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                @endif
                                <li class="border-bottom-none">
                                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="sr-only">(current)</span></a>
                                    <li class="mobile-menu add-job border-bottom-none"><a href="#">POST A JOB, IT’S FREE!</a></li>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Home#2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jobs</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Browse Jobs</a></li>
                                        <li><a href="#">Browse jobs alternative</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Job Style One</a></li>
                                        <li><a href="#">Job Style Two</a></li>
                                        <li><a href="#">Job Preview</a></li>
                                        <li><a href="#">Resume Page</a></li>
                                        <li><a href="#">Companies</a></li>
                                        <li><a href="#">Pricing Table</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">How It Works</a></li>
                                <li><a href="#">Contact</a></li>
                                <li class="mobile-menu"><a href="post-a-job.html">POST A JOB, IT’S FREE!</a></li>
                                <li class="mobile-menu"><a href="{{ url('/register') }}">Register</a></li>
                                <li class="mobile-menu"><a href="{{ url('/login') }}">Login</a></li>
                              </ul>
                        </div><!-- navbar-collapse -->

                    </div>
                    <!-- container-fluid -->
                </nav>

                @yield('header-slogan')

            </div>

            @yield('header-section')
        </div>
    </div>

    @yield('content')

    <div class="container-fluid footer">
        <div class="row">
            <div class="container main-container-home">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h3>Pages</h3>
                    <ul class="list-group">
                        <li><a href="#">Job page</a></li>
                        <li><a href="#">Job page alternative</a></li>
                        <li><a href="#">Post a job</a></li>
                        <li><a href="#">Browse jobs</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Price table</a></li>
                        <li><a href="#">Companies</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Blog post</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>
                <!---Footer Column 01-->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h3>Other page</h3>
                    <ul class="list-group">
                        <li><a href="#">Login/Register</a></li>
                        <li><a href="#">Lost passoword</a></li>
                        <li><a href="#">Payment</a></li>
                        <li><a href="#">Confirm payment</a></li>
                        <li><a href="#">Sumbit resume</a></li>
                        <li><a href="#">Resume</a></li>
                        <li><a href="#">Terms and conditions</a></li>
                    </ul>
                </div>
                 <!---Footer Column 01-->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h3>Contact with us</h3>
                        <p>Manchester Road 123-78B, <br/>Silictown</p>
                        <p>+46 123 456 789</p>
                        <p>hello@sitename.com</p>
                        <p>http://www.sitename.com</p>
                </div>
                 <!---Footer Column 01-->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h3>About us</h3>
                    <p>An employment website is a web site that deals specifically with employment or careers. Many employment websites are designed to allow employers to post job requirements for a position to be filled and are commonly known as job boards</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid footer last-footer ">
        <div class="row">
            <div class="container main-container">
                <div class="col-lg-9 col-md-3 col-sm-9 col-xs-6" >
                    <p class="copyright">© template by DeximLabs.com All Rights Reserved.</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <ul class="list-group">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/front-app.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/parallax.js-1.4.2/parallax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/owlslider/owl-carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/counter/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/webjs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

    <script>$(window).load(function() { $("#loadessr").fadeOut(); @yield('asset_js') })</script>
</body>
</html>
