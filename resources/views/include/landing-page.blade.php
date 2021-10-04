<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Epic-Themes">
    <meta name="keywords" content="Perfect Money, PM, BTC, USDT, ETH, Buy Perfect Money flawlessly, Buy Bitcoin with ease, Buy Etherium without hassles, Bitcoin, Sell Perfect Money, Sell PM, Buy BTC, Sell BTC, Sell Bitcoin, Reliable Exchanger,BTC exchanger, PM exchanger, ETH exchanger, USDT exchanger, Sell USDT, ETH, Bitcoin, Competitive rates, Cheapest PM,BTC,USDT,ETH rates, Bitcoin,USDT,ETH,PM,Perfect Money exchanger in Nigeria, Best rates">
    <meta name="description" content="Pm247crypto.com is a  reliable Exchanger where users can buy and sell Perfect Money (PM), BTC, USDT and ETH flawlessly.">
    <!-- Loading Bootstrap -->
    <link href="{{asset('landing/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}"><!-- Site Title  -->
    <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title><!-- Bundle and Base CSS -->
    <!-- Loading Template CSS -->
    <link href="{{asset('landing/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/style-magnific-popup.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">

    <!-- Font Favicon -->

</head>

<body>


    <!-- begin header -->
    <header>

        <nav class="navbar navbar-expand-lg navbar-fixed-top">

            <div class="container">

                <!-- begin logo -->
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" class="img-fluid" style="width: 30px;" alt="logo">
                    <!-- <i class="bi bi-intersect"></i> -->
                </a>
                <!-- end logo -->


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">

                    <!-- begin navbar-nav -->
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll justify-content-center">

                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>

                        <li class="nav-item"><a class="nav-link" href="#how-it-works">FAQ</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{route('buy')}}">Buy E-Currency</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('sell')}}">Sell E-Currency</a></li>

                        <li class="nav-item"><a class="nav-link" href="#rates">Exchange Rates</a></li>

                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                    </ul>

                    <div class="col-md-3 text-end">
                        <a href="{{route('login')}}"><button type="button" class="btn btn-link"><i class="bi bi-person"></i> Login</button></a>
                        <a href="{{route('register')}}"><button type="button" class="btn btn-primary">Sign-up</button></a>
                    </div>
                </div>

            </div>

        </nav>

    </header>
    <!-- end header -->

    <main>

        @yield('content')

        <!--begin footer -->
        <div class="footer">

            <!--begin container -->
            <div class="container">

                <!--begin row -->
                <div class="row">

                    <!--begin col-md-7 -->
                    <div class="col-md-7">
                        <p>&copy; {{date('Y')}} <span class="template-name">{{$basic->sitename}}.com</span></p>

                    </div>
                    <!--end col-md-7 -->

                    <!--begin col-md-5 -->
                    <div class="col-md-5">

                        <!--begin footer_social -->
                        <ul class="footer_social">

                            <li>Follw us:</li>

                            <li><a href="#" class="twitter"><i class="bi bi-twitter"></i></a></li>

                            <li><a href="#" class="instagram"><i class="bi bi-instagram"></i></a></li>

                            <li><a href="+234 708 489 5638" class="whatsapp"><i class="bi bi-whatsapp"></i></a></li>

                            <li><a href="#" class="google"><i class="bi bi-google"></i></a></li>

                            <li><a href="#" class="github"><i class="bi bi-github"></i></a></li>

                        </ul>
                        <!--end footer_social -->

                    </div>
                    <!--end col-md-5 -->

                </div>
                <!--end row -->

            </div>
            <!--end container -->

        </div>
        <!--end footer -->

    </main>

    <!-- Load JS here for greater good =============================-->
    <script src="{{asset('landing/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('landing/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing/js/jquery.scrollTo-min.js')}}"></script>
    <script src="{{asset('landing/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('landing/js/jquery.nav.js')}}"></script>
    <script src="{{asset('landing/js/wow.js')}}"></script>
    <script src="{{asset('landing/js/plugins.js')}}"></script>
    <script src="{{asset('landing/js/custom.js')}}"></script>

</body>

</html>