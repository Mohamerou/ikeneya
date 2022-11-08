<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>i-Keneya</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('landing-page/assets/images/logo/logo.png') }}">

  <!-- <link rel="shortcut icon" href="{{ asset('landing-page/') }}assets/images/logo/favicon.png" type="image/x-icon"> -->

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/animate-3.7.0.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/font-awesome-4.7.0.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/bootstrap-4.1.3.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/owl-carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/jquery.datetimepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/linearicons.css') }}">
  <link rel="stylesheet" href="{{ asset('landing-page/assets/css/style.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

  <!-- Authentication style links -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

  <!-- CSS only -->

</head>

<!-- Header Area Starts -->
<header class="header-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 d-md-flex">
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-mobile"></i></span> Contacter nous! +223 79 38 74 23</h6>
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-envelope-o"></i></span> info@ikeneya.com</h6>
                    <h6><span class="mr-2"><i class="fa fa-map-marker"></i></span> Bamako</h6>
                </div>
                <div class="col-lg-3">
                    <div class="social-links">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header" id="home">
        <div class="container">
          <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
              <a href="#"><img src="{{ asset('landing-page/assets/images/logo/logo.png') }}" alt="" title="" /></a>
          </div>
          <nav id="nav-menu-container">
              <ul class="nav-menu">
                  <li class="menu-active"><a href="{{ route('welcome') }}">Accueil</a></li>
                  <li><a href="{{ route('partners') }}">Nos partenaires</a></li>
                  <li><a href="{{ route('specialists') }}">doctors</a></li>
                  <li class="menu-has-children"><a href="#">blog</a>
                      <ul>
                          <li><a href="#">Tous les blogs</a></li>
                          <li><a href="#">blog details</a></li>
                      </ul>
                  </li>
                  <li><a href="{{ route('contact') }}">Contact</a></li>
                  <li><a href="{{ route('subscription') }}">S'Abonner</a>
                      <!-- <ul>
                          <li><a href="about.html">Bronze</a></li>
                          <li><a href="elements.html">Silver</a></li>
                          <li><a href="elements.html">GOLD</a></li>
                      </ul> -->
                  </li>
                  <li><a href="{{ route('login.show') }}" class="btn btn-primary btn-sm">Mon Compte</a></li>
              </ul>
          </nav>
          </div>
      </div>
    </div>
</header>
<!-- Header Area End -->

    @yield('content')





    <!-- Footer Area Starts -->
    <footer class="footer-area section-padding">
        <!-- <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-3">
                        <div class="single-widget-home mb-5 mb-lg-0">
                            <h3 class="mb-4">top products</h3>
                            <ul>
                                <li class="mb-2"><a href="#">managed website</a></li>
                                <li class="mb-2"><a href="#">managed reputation</a></li>
                                <li class="mb-2"><a href="#">power tools</a></li>
                                <li><a href="#">marketing service</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 offset-xl-1 col-lg-6">
                        <div class="single-widget-home mb-5 mb-lg-0">
                            <h3 class="mb-4">newsletter</h3>
                            <p class="mb-4">You can trust us. we only send promo offers, not a single.</p>
                            <form action="#">
                                <input type="email" placeholder="Your email here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email here'" required>
                                <button type="submit" class="template-btn">subscribe now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-1 col-lg-3">
                        <div class="single-widge-home">
                            <h3 class="mb-4">instagram feed</h3>
                            <div class="feed">
                                <img src="{{ asset('landing-page/assets/images/feed1.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed2.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed3.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed4.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed5.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed6.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed7.jpg') }}" alt="feed">
                                <img src="{{ asset('landing-page/assets/images/feed8.jpg') }}" alt="feed">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <span>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
&copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</span>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="social-icons">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->
<body>

    <!-- Javascript -->
    <script src="{{ asset('landing-page/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
	<script type="javascript" src="{{ asset('landing-page/assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
    <script src="{{ asset('landing-page/assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('landing-page/assets/js/vendor/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('landing-page/assets/js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('landing-page/assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('landing-page/assets/js/vendor/superfish.min.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/main.js') }}"></script>

  <!-- Authentication scripts -->
<script src="{{ asset('auth/js/jquery.min.js') }}"></script>
  <script src="{{ asset('auth/js/popper.js') }}"></script>
  <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('auth/js/main.js') }}"></script>

    </body>
  </html>
