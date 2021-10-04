<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Coin">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content=""><!-- Fav Icon  -->
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}"><!-- Site Title  -->
  <title>{{ isset($page_title) ? $page_title : '' }} | {{ $basic->sitename }}</title><!-- Bundle and Base CSS -->
  <link rel="stylesheet" href="{{ asset('front-assets/css/vendor.bundle-11966.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/css/style-salvia-11966.css') }}" id="changeTheme">
  <link href="{{ asset('assets/admin/css/sweetalert.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/toastr.min.css') }}" rel="stylesheet" />

  <link href="{{ asset('front-assets/css/jquery.growl.css') }}" rel="stylesheet" />

  <!-- Extra CSS -->
  <link rel="stylesheet" href="{{ asset('front-assets/css/theme-11966.css') }}">
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o), m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-91615293-2', 'auto');
    ga('send', 'pageview');
  </script>
</head>

<body class="nk-body body-wider theme-dark mode-onepage">

  <body class="nk-body body-wider bg-light-alt">
    <div class="nk-wrap">
      <main class="nk-pages nk-pages-centered" style="background-color: #024C5D !important">
        <div class="ath-container">
          <div class="ath-header text-center">
            <center><a href="{{ url('/') }}" class="logo-link"><img class="logo-dark" src="{{ asset('assets/images/logo/logo.png') }}" srcset="{{ asset('assets/images/logo/logo.png') }}" width="70" alt="logo"><img class="logo-light" src="{{ asset('assets/images/logo/logo.png') }}" srcset="{{ asset('assets/images/logo/logo.png') }}" width="70 alt=" logo"></a>
            </center>
          </div>
          <div class="ath-body">
            <h5 class="ath-heading title">Sign in <small class="tc-default">With Your
                {{ $basic->sitename }} Account</small></h5>
            <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate="">
              @csrf
              <div class="field-item">
                <div class="field-wrap"><input type="text" class="input-bordered" name="username" placeholder="Your Username"></div>
              </div>
              <div class="field-item">
                <div class="field-wrap">
                  <input type="password" name="password" class="input-bordered" placeholder="Password">
                </div>
              </div>
              <div class="field-item">
                <button type="submit" class="btn btn-primary btn-block btn-md">Sign In</button>
              </div>
              <div class="field-item d-flex justify-content-between align-items-center">
                <div class="field-item pb-0">
                  <input class="input-checkbox" id="remember-me-100" type="checkbox"><label for="remember-me-100">Remember Me</label>
                </div>
                <div class="forget-link fz-6"><a href="#" data-toggle="modal" data-dismiss="modal" data-target="#reset-popup">Forgot password?</a></div>
              </div>
            </form>
          </div>
          <div class="ath-note text-center tc-light"> Don’t have an account? <a href="{{ route('register') }}"> <strong>Sign up here</strong></a></div>
        </div>
      </main>
    </div>
    <div class="preloader"><span class="spinner spinner-round"></span></div><!-- JavaScript -->
    <!-- Modal @s -->
    <div class="modal fade" id="reset-popup">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
          <div class="ath-container m-0">
            <div class="ath-body">
              <h5 class="ath-heading title">Reset <small class="tc-default">with your Email</small></h5>
              <form method="POST" action="{{ route('user.password.email') }}">
                @csrf<div class="field-item">
                  <div class="field-wrap"><input type="email" name="email" value="{{ old('email') }}" class="input-bordered" placeholder="Your Email"></div>
                </div><button type="submit" class="btn btn-primary btn-block btn-md">Reset Password</button>
                <div class="ath-note text-center"> Remembered? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login-popup"> <strong>Sign in here</strong></a></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- .modal @e -->
    <!-- JavaScript -->
    <script src="{{ asset('front-assets/js/jquery.bundle.js?ver=192') }}"></script>
    <script src="{{ asset('front-assets/js/scripts.js?ver=192') }}"></script>
    <script src="{{ asset('front-assets/js/charts.js?var=161') }}"></script>

    @yield('script')
    <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/sweetalert.js') }}"></script>

    <script src="{{ asset('front-assets/js/rainbow.js') }}"></script>
    <script src="{{ asset('front-assets/js/sample.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.growl.js') }}"></script>

    <script src="{{ asset('front-assets/js/pace.min.js') }}"></script>


    @yield('js')
    @if (session('alert'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ session('alert') }}"
          });
        });
      }).call(this);
    </script>
    @endif


    @if ($errors->has('fname'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('fname') }}"
          });
        });
      }).call(this);
    </script>
    @endif

    @if ($errors->has('lname'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('lname') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if ($errors->has('username'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('username') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if ($errors->has('phone'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('phone') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if ($errors->has('email'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('email') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if ($errors->has('password'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('password') }}"
          });
        });
      }).call(this);
    </script>
    @endif


    @if (Session::has('success'))
    <script>
      (function() {
        $(function() {
          return $.growl.notice({
            message: "{{ Session::get('success') }}"
          });
        });
      }).call(this);
    </script>
    @endif

    @if (session('message'))
    <script>
      (function() {
        $(function() {
          return $.growl.notice({
            message: "{{ session('message') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if (Session::has('danger'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ session('danger') }}"
          });
        });
      }).call(this);
    </script>
    @endif

    @if ($errors->has('sms_code'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('sms_code') }}"
          });
        });
      }).call(this);
    </script>
    @endif

    @if ($errors->has('email_code'))
    <script>
      (function() {
        $(function() {
          return $.growl.error({
            message: "{{ $errors->first('email_code') }}"
          });
        });
      }).call(this);
    </script>
    @endif
    @if (Session::has('ref'))
    <script>
      swal("Hello", "{!! session()->get('ref') !!}", "info");
    </script>
    @endif
    @if (Session::has('referror'))
    <script>
      swal("Hello", "{!! session()->get('referror') !!}", "error");
    </script>
    @endif
  </body>

</html>