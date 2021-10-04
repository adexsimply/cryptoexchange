<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
  <meta charset="utf-8">
  <meta name="author" content="{{$basic->sitename}}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{$basic->sitename}} Crypto currency trading system."><!-- Fav Icon -->
  <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}"><!-- Site Title  -->
  <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}} </title><!-- Vendor Bundle CSS -->
  <link rel="stylesheet" href="{{asset('dash-assets/css/vendor.bundle-62688.css')}}">
  <link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
  <script src="{{asset('process/countries.js')}}"></script>
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{asset('dash-assets/css/')}}/{{$basic->theme}}" id="layoutstyle">
</head>

<body class="page-user toastr-info">
  <div class="topbar-wrap">
    <div class="topbar is-sticky">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <ul class="topbar-nav d-lg-none">
            <li class="topbar-nav-item relative"><a class="toggle-nav" href="#">
                <div class="toggle-icon"><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span></div>
              </a></li><!-- .topbar-nav-item -->
          </ul><!-- .topbar-nav --><a class="topbar-logo" href="{{route('home')}}"><img src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" alt="logo"></a>
          <ul class="topbar-nav">
            <li class="topbar-nav-item relative"><span class="user-welcome d-none d-lg-inline-block">Welcome! {{Auth::user()->username}}</span>
              <a class="toggle-tigger user-thumb" href="#">
                <div class="user-photo">
                  @if( file_exists(Auth::User()->image))
                  <img src="{{asset(Auth::user()->image)}} " width="100" alt="Profile Pic">
                  @else
                  <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">
                  @endif
                </div>
              </a>
              <div class="toggle-class dropdown-content dropdown-content-right dropdown-arrow-right user-dropdown">
                <div class="user-status">
                  <h6 class="user-status-title">Balance</h6>
                  <div class="user-status-balance">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}} <small>{{$basic->currency}}</small></div>
                </div>
                <div class="user-status">
                  <h6 class="user-status-title">Referral Bonus</h6>
                  <div class="user-status-balance">{{number_format(Auth::user()->bonus, $basic->decimal)}} <small>{{$basic->currency}}</small></div>
                </div>
                <ul class="user-links">
                  <li><a href="{{route('notifications')}}"><i class="ti ti-announcement"></i>Notifications</a></li>
                  <li><a href="{{route('referral')}}"><i class="ti ti-infinite"></i>Referral</a></li>
                  <li><a href="{{route('activities')}}"><i class="ti ti-eye"></i>Activity</a></li>
                </ul>
                <ul class="user-links bg-light">
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti ti-power-off"></i>Logout</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              </div>
            </li><!-- .topbar-nav-item -->
          </ul><!-- .topbar-nav -->
        </div>
      </div><!-- .container -->
    </div><!-- .topbar -->
    <div class="navbar">
      <div class="container">
        <div class="navbar-innr">
          <ul class="navbar-menu">
            <li><a href="{{route('home')}}"><em class="text-primary ti ti-dashboard"></em>&nbsp; Dashboard</a></li>
            <li class="has-dropdown page-links-all"><a class="drop-toggle" href="#"><em class="text-primary ti ti-wallet"></em>&nbsp; Deposit</a>
              <ul class="navbar-dropdown">
                <li><a href="{{route('make_deposit')}}"><em class="text-primary ti ti-wallet"></em>&nbsp; New Deposit</a></li>
                <li><a href="{{route('deposit')}}"><em class="text-primary ti ti-server"></em>&nbsp; Deposit Log</a></li>
              </ul>
            </li>
            <li class="has-dropdown page-links-all"><a class="drop-toggle" href="#"><em class="text-primary ti ti-wallet"></em>&nbsp; Withdraw</a>
              <ul class="navbar-dropdown">
                <li><a href="{{route('withdraw_fund')}}"><em class="text-primary ti ti-wallet"></em>&nbsp; New Withdrawal</a></li>
                <li><a href="{{url('user/withdraw-history')}}"><em class="text-primary ti ti-server"></em>&nbsp; Withdrawals Log</a></li>
              </ul>
            </li>
            <li class="has-dropdown page-links-all"><a class="drop-toggle" href="#"><em class="text-primary ti ti-user"></em>&nbsp; Trade</a>
              <ul class="navbar-dropdown">
                <li><a href="{{route('buy')}}"><em class="text-primary ti ti-shopping-cart"></em>&nbsp; Buy E-Currency</a></li>
                <li><a href="{{route('sell')}}"><em class="text-primary ti ti-server"></em>&nbsp; Sell E-Currency</a></li>
                <li><a href="{{route('transaction')}}"><em class="text-primary ti ti-book"></em>&nbsp; Transaction Log</a></li>
              </ul>
            </li>
            </li>


            <li class="page-links-all"><a href="{{route('verification')}}"><em class="text-primary ti ti-id-badge"></em>&nbsp; Verification</a></li>


            <li class="has-dropdown page-links-all"><a class="drop-toggle" href="#"><em class="text-primary ti ti-user"></em>&nbsp; Profile</a>
              <ul class="navbar-dropdown">
                <li class=" "><a class="" href="{{route('profile')}}">My Profile</a></li>
                <li class=" "><a class="" href="{{route('referral')}}">Referral System</a></li>
                <li class=" "><a class="" href="{{route('activities')}}">Activity Log</a></li>
                <li class=" "><a class="" href="{{route('user.testimonial')}}">Post Testimonial</a></li>
              </ul>
            </li>

            </li>


            @php
            $count = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();
            @endphp
            <li class="has-dropdown page-links-all"><a class="drop-toggle" href="#"><em class="text-primary ti ti-email"></em>&nbsp; Messages </a>
              <ul class="navbar-dropdown">
            </li>
            <li class=" "><a class="" href="{{route('createmessage')}}">Create Message</a></li>

            <li class=" "><a class="" href="{{route('inbox')}}">Messages Inbox @if($count > 0) <span class="badge badge-warning">{{$count}} New</span>@endif</a></li>
            <li class=" "><a class="" href="{{route('user.testimonial')}}">Create Testimonial</a></li>
            <li class=" "><a class="" href="{{route('user.faq')}}">FAQs</a></li>
          </ul>
          </li>

        </div><!-- .navbar-innr -->
      </div><!-- .container -->
    </div><!-- .navbar -->
  </div><!-- .topbar-wrap -->

  @yield('content')





  <div class="footer-bar">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-8">
          <ul class="footer-links">
            <!-- <li><a href="{{route('user.faq')}}">FAQs</a></li>
            <li><a href="{{url('/#privacy')}}">Privacy Policy</a></li>
            <li><a href="{{url('/#privacy')}}">Terms of Condition</a></li> -->
          </ul>
        </div><!-- .col -->
        <div class="col-md-4 mt-2 mt-sm-0">
          <div class="d-flex justify-content-between justify-content-md-end align-items-center guttar-25px pdt-0-5x pdb-0-5x">
            <div class="copyright-text">&copy; {{date('Y')}} {{$basic->sitename}}.</div>
            <div class="lang-switch relative"><a href="#" class="lang-switch-btn toggle-tigger">En <em class="ti ti-angle-up"></em></a>
              <div class="toggle-class dropdown-content dropdown-content-up">
                <ul class="lang-list">
                  <li><a href="#">Fr</a></li>
                  <li><a href="#">Bn</a></li>
                  <li><a href="#">Lt</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container -->
  </div><!-- .footer-bar -->
  <!-- JavaScript (include all script here) -->
  <script src="{{asset('dash-assets/js/jquery.bundle.js?ver=104')}}"></script>
  <script src="{{asset('dash-assets/js/script.js?ver=104')}}"></script>
  <script src="{{asset('front-assets/js/rainbow.js')}}"></script>
  <script src="{{asset('front-assets/js/sample.js')}}"></script>
  <script src="{{asset('front-assets/js/jquery.growl.js')}}"></script>
  <script src="{{asset('front-assets/js/script2.js')}}"></script>
  <script src="{{asset('front-assets/js/pace.min.js')}}"></script>

  @yield('js')

  @if (session('alert'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ session("alert") }}')
      });
    }(jQuery);
  </script>
  @endif
  @if(Session::has('success'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.success("<em class='ti ti-check toast-message-icon'></em> {{ Session::get('success') }}")
      });
    }(jQuery);
  </script>

  @endif

  @if(Session::has('error'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !1,
            positionClass: "toast-top-center",
            preventDuplicates: !0,
            showDuration: "1000",
            hideDuration: "10000",
            timeOut: "9000",
            extendedTimeOut: "1000"
          },
          toastr.error("<em class='ti ti-check toast-message-icon'></em> {{ Session::get('error') }}")
      });
    }(jQuery);
  </script>
  @endif


  @if(Session::has('warning'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.warning("<em class='ti ti-check toast-message-icon'></em> {{ Session::get('warning') }}")
      });
    }(jQuery);
  </script>
  @endif

  @if (session('message'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.success('<em class="ti ti-check toast-message-icon"></em> {{ session("message") }}')
      });
    }(jQuery);
  </script>
  @endif
  @if(Session::has('danger'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ session("danger") }}')
      });
    }(jQuery);
  </script>
  @endif

  @if ($errors->has('fname'))

  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first("fname") }}')
      });
    }(jQuery);
  </script>
  @endif

  @if ($errors->has('lname'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first("lname") }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('username'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          username ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('phone'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          phone ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('email'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          email ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('password'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          password ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('currency'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          country ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('address'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          address ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('zip_code'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          zip_code ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('current_password'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          currenct_password ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('password_confirmation'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          password_confrimation ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->has('city'))
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $errors->first('
          city ') }}')
      });
    }(jQuery);
  </script>
  @endif
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <script>
    ! function(t) {
      "use strict";
      var c = t(".toastr-info");
      c.length > 0 && c.ready(function() {
        toastr.clear(), toastr.options = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !0,
          progressBar: !1,
          positionClass: "toast-top-center",
          preventDuplicates: !0,
          showDuration: "1000",
          hideDuration: "10000",
          timeOut: "9000",
          extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> {{ $error }}')
      });
    }(jQuery);
  </script>

  @endforeach

  @endif
  <!-- Modal End -->
  <div class="modal fade" id="deposit-online" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
      <div class="modal-content pb-0">
        <div class="popup-body">
          <h4 class="popup-title">Fund Your Deposit Wallet</h4>
          <p class="lead">You currently have <span>{{$basic->currency}}{{number_format(Auth::user()->balance, $basic->decimal)}}</span> in your deposit wallet. Fill the form below to proceed.</p>
          <p>You can choose any of following payment method to fund your wallet. The fund will appear in your account after successfull payment.</p>
          <h5 class="mgt-1-5x font-mid">Select payment method:</h5>
          <form method="post" action="{{route('deposit.data-insert')}}">
            @csrf
            <select class="input-bordered select-block" required name="gateway">
              <option>Choose... For Me now dude</option>
              <option value="bank">Bank Transfer</option>
              @foreach($gates as $gate)
              <option data-charge="{{$gate->percent_charge}}" value="{{$gate->id}}">{{$gate->name}}</option>
              @endforeach
            </select>
            <h5 class="mgt-1-5x font-mid">Enter Amount:</h5>
            <div class="copy-wrap mgb-0-5x">
              <input required type="number" name="amount" class="copy-address">
              <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
            </div>
            <span class="text-light font-italic mgb-2x"><small>* Payment gateway company may charge you a processing fees.</small></span>
            <div class="pdb-2-5x pdt-1-5x"><input required type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term-3"><label for="agree-term-3">I hereby agree to the <strong>token purchase aggrement &amp; token sale term</strong>.</label></div>
            <ul class="d-flex flex-wrap align-items-center guttar-30px">
              <li><button type="submit" class="btn btn-primary">Accept &amp; Process Payment <em class="ti ti-arrow-right mgl-2x"></em></a></li>
            </ul>
            <div class="gaps-2x"></div>
            <div class="gaps-1x d-none d-sm-block"></div>
            <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
              <p class="text-light">You will automatically redirect for payment after your order placing.</p>
          </form>
        </div>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog -->
  </div><!-- Modal End -->


  @if(Auth::user()->time < $time ) <!-- Modal End -->
    <div class="modal fade" id="pay-review" tabindex="-1">
      <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
          <div class="popup-body text-center">
            <div class="gaps-2x"></div>
            <div class="pay-status pay-status-success"><em class="ti ti-check"></em></div>
            <div class="gaps-2x"></div>
            <h3>Congratulations</h3>
            <p>Its a new day to earn your daily bonus. Please click the button below to earn your {{$basic->currency_sym}}{{$basic->bonus}} bonus for the day</p>
            <div class="gaps-2x"></div>
            <a href="{{ route('userDailyBonus') }}" class="btn btn-primary">Earn Bonus</a>

            <div class="gaps-1x"></div>
          </div>
        </div><!-- .modal-content -->
      </div><!-- .modal-dialog -->
    </div><!-- Modal End -->
    @else
    <div class="modal fade" id="pay-review" tabindex="-1">
      <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
          <div class="popup-body text-center">
            <div class="gaps-2x"></div>
            <div class="pay-status pay-status-error"><em class="ti ti-alert"></em></div>
            <div class="gaps-2x"></div>
            <h3>Oops! Earning Failed!</h3>
            <p>Sorry, You have already earned your bonus for the day. Please come back later for new earning.<br> Time remaining for next earning: <strong>

                <br>
                <a href="#" id="demo"> Please Wait
                </a></strong>
              <script>
                // Set the date we're counting down to
                var countDownDate = new Date("{{Auth::user()->time}}").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                  // Get today's date and time
                  var now = new Date().getTime();

                  // Find the distance between now and the count down date
                  var distance = countDownDate - now;

                  // Time calculations for days, hours, minutes and seconds
                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);



                  // Display the result in the element with id="demo"
                  if (days > 0) {
                    document.getElementById("demo").innerHTML = days + "Days " + hours + "Hrs " +
                      minutes + "Mins " + seconds + "Secs ";
                  } else {
                    document.getElementById("demo").innerHTML = days + "Day " + hours + "Hrs " +
                      minutes + "Mins " + seconds + "Secs ";
                  }
                  // If the count down is finished, write some text

                }, 1000);
              </script>

              </strong>.
            </p>
            <div class="gaps-2x"></div><a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
            <div class="gaps-1x"></div>
          </div>
        </div><!-- .modal-content -->
      </div><!-- .modal-dialog -->
    </div><!-- Modal End -->
    @endif




</body>

</html>