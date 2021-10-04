<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
	<meta charset="utf-8">
	<meta name="author" content="{{$basic->sitename}}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""><!-- Fav Icon  -->
	<link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}"><!-- Site Title  -->
	<title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title><!-- Bundle and Base CSS -->
	<link rel="stylesheet" href="{{asset('front-assets/css/vendor.bundle-11966.css')}}">
	<link rel="stylesheet" href="{{asset('front-assets/css/style-salvia-11966.css')}}" id="changeTheme">
	<link href="{{asset('assets/admin/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet" />

	<link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />

	<!-- Extra CSS -->
	<link rel="stylesheet" href="{{asset('front-assets/css/theme-11966.css')}}">
</head>

<body class="nk-body body-wider theme-dark mode-onepage">

	<body class="nk-body body-wider theme-dark mode-onepage">
		<div class="nk-wrap">
			<header class="nk-header page-header is-transparent is-sticky is-shrink" id="header">
				<!-- Header @s -->
				<div class="header-main" style="background-color: #024C5D !important;">
					<div class="container">
						<div class="header-wrap">
							<!-- Logo @s -->
							<div class="header-logo logo animated" data-animate="fadeInDown" data-delay=".65"><a href="{{url('/')}}" class="logo-link"><img class="logo-dark" src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" alt="logo"><img class="logo-light" src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" alt="logo"></a></div><!-- Menu Toogle @s -->
							<div class="header-nav-toggle"><a href="#" class="navbar-toggle" data-menu-toggle="header-menu">
									<div class="toggle-line"><span></span></div>
								</a></div><!-- Menu @s -->
							<div class="header-navbar header-navbar-s2">
								<nav class="header-menu justify-content-between" id="header-menu">
									<ul class="menu animated remove-animation" data-animate="fadeInDown" data-delay=".75">

										<li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#about">About</a></li>

										<!-- <li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#overview">Overview</a></li>


										<li class="menu-item"><a class="menu-link nav-link" href="{{url('/blog')}}">Blog</a></li> -->


										<!-- <li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#works">How It Works</a></li>

										<li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#document">Download</a></li> -->

										<li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#faq">FAQ</a></li>

										<li class="menu-item"><a class="menu-link nav-link" href="{{url('/rates')}}">Exchange Rate</a></li>
										<li class="menu-item"><a class="menu-link nav-link" href="{{route('buy')}}">Buy E-currency</a></li>
										<li class="menu-item"><a class="menu-link nav-link" href="{{route('sell')}}">Sell E-currency</a></li>

										<li class="menu-item"><a class="menu-link nav-link" href="@if(request()->path() == 'rates'){{url('/')}}@elseif(request()->path() == 'privacy'){{url('/')}}@endif#contact">Contact</a></li>

										<!-- <li class="menu-item has-sub"><a class="menu-link nav-link menu-toggle" href="#">More</a>
											<ul class="menu-sub menu-drop">
												<li class="menu-item"><a class="menu-link nav-link" href="{{url('/rates')}}">Exchange Rate</a></li>
												<li class="menu-item"><a class="menu-link nav-link" href="{{url('/privacy')}}">Terms & Conditions</a></li>
											</ul>
										</li> -->
									</ul>
									<ul class="menu-btns align-items-center animated remove-animation" data-animate="fadeInDown" data-delay=".85">

										@if(Auth::user())
										<li><a href="{{route('home')}}" class="btn btn-rg btn-secondary no-change"><span>Dashboard</span></a></li>

										<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline btn-rg btn-danger no-change"><span>Logout</span></a></li>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
										@else

										<li class="language-switcher language-switcher-s2 toggle-wrap"><a class="btn btn-rg   btn-outline btn-auto no-change btn-primary" href="{{route('login')}}"><span>Login</span> </a></li>
										@if($basic->registration > 0)
										<li><a href="{{route('register')}}" class="btn btn-rg btn-secondary no-change"><span>Register</span></a></li> @endif @endif
									</ul>
								</nav>
							</div><!-- .header-navbar @e -->
						</div>
					</div>
				</div><!-- .header-main @e -->
				<!-- Banner @s -->
				<div class="header-banner bg-theme-grad"></div><!-- .header-banner @e -->
			</header>

			@yield('content')

			<footer class="nk-footer bg-theme ov-h overlay-x fw-4" style="background-color: #024C5D !important;">
				<section class="section section-m  tc-light tc-light-alt bg-transparent">
					<div class="container">
						<!-- Block @s -->
						<div class="nk-block nk-block-footer">
							<div class="row justify-content-between text-center text-sm-left">
								<div class="col-lg-3 col-md-4 col-sm-5">
									<div class="wgs wgs-menu">
										<h6 class="wgs-title text-white animated" data-animate="fadeInUp" data-delay=".1">Address</h6>
										<div class="wgs-body">
											<ul class="wgs-list mt-3 animated" data-animate="fadeInUp" data-delay=".2">
												<li>{{$basic->sitename}} <br> Company Number {{$basic->phone}}</li>
												<li>{{$basic->address}}</li>
											</ul>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-lg-2 col-md-4 col-sm-3">
									<div class="wgs wgs-menu">
										<h6 class="wgs-title text-white animated" data-animate="fadeInUp" data-delay=".3">Resorces</h6>
										<div class="wgs-body">
											<ul class="wgs-links wgs-links-s3 animated" data-animate="fadeInUp" data-delay=".4">
												<li><a href="#">API</a></li>
												<li><a href="#">Policies</a></li>
												<li><a href="{{url('/rates')}}">X-Rates</a></li>
											</ul>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-lg-2 col-md-4 col-sm-3">
									<div class="wgs wgs-menu">
										<h6 class="wgs-title text-white animated" data-animate="fadeInUp" data-delay=".5">Sitemap</h6>
										<div class="wgs-body">
											<ul class="wgs-links wgs-links-s3 animated" data-animate="fadeInUp" data-delay=".6">
												<li><a href="#">Home</a></li>
												<li><a href="#about">About</a></li>
												<li><a href="#faq">FAQs</a></li>
											</ul>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-lg-4 col-md-8 offset-lg-1">
									<div class="wgs wgs-text">
										<div class="wgs-logo animated" data-animate="fadeInUp" data-delay=".7"><a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" width="80" alt="logo"></a></div>
										<div class="wgs-body">
											<div class="wgs-subscribe wgs-subscribe-s2">
												<p class="animated" data-animate="fadeInUp" data-delay=".8">{{$basic->hstitle}}</p>
												<ul class="social pt-2">
													<li class="animated" data-animate="fadeInUp" data-delay="1.7"><a href="{{$basic->facebook}}"><em class="social-icon fab fa-facebook-f"></em></a></li>
													<li class="animated" data-animate="fadeInUp" data-delay="1.75"><a href="{{$basic->twitter}}"><em class="social-icon fab fa-twitter"></em></a></li>
													<li class="animated" data-animate="fadeInUp" data-delay="1.8"><a href="{{$basic->google}}"><em class="social-icon fab fa-google-plus"></em></a></li>
													<li class="animated" data-animate="fadeInUp" data-delay="1.8"><a href="{{$basic->instagram}}"><em class="social-icon fab fa-instagram"></em></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div><!-- .col -->
							</div><!-- .row -->
							<div class="footer-bottom pdt-r">
								<div class="copyright-text copyright-text-s1 text-center text-sm-left text-lg-center">
									<p>&copy; {{date('Y')}} <a href="{{url('/')}}">.</a> <a class="ml-4" href="{{url('/')}}">{{$basic->sitename}}</a></p>
								</div>
							</div>
						</div><!-- .block @e -->
					</div>
				</section>
			</footer>
		</div>
		<div class="preloader"><span class="spinner spinner-round"></span></div>




		<!-- Modal @s -->



		<div class="modal fade" id="login-popup">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
					<div class="ath-container m-0">
						<div class="ath-body">
							<h5 class="ath-heading title">Sign in <small class="tc-default">with your {{$basic->sitename}} Account</small></h5>

							<form action="{{ route('login') }}" method="post" class="needs-validation" novalidate="">
								@csrf <div class="field-item">
									<div class="field-wrap"><input type="text" class="input-bordered" name="username" placeholder="Your Username"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input type="password" name="password" class="input-bordered" placeholder="Password"></div>
								</div>
								<div class="field-item d-flex justify-content-between align-items-center">
									<div class="field-item pb-0"><input class="input-checkbox" id="remember-me-100" type="checkbox"><label for="remember-me-100">Remember Me</label></div>
									<div class="forget-link fz-6"><a href="#" data-toggle="modal" data-dismiss="modal" data-target="#reset-popup">Forgot password?</a></div>
								</div><button type="submit" class="btn btn-primary btn-block btn-md">Sign In</button>
							</form>
							<div class="sap-text"><span>Or Sign In With</span></div>
							<ul class="row gutter-20px gutter-vr-20px">
								<li class="col"><a href="#" class="btn btn-md btn-facebook btn-block"><em class="icon fab fa-facebook-f"></em><span>Facebook</span></a></li>
								<li class="col"><a href="#" class="btn btn-md btn-google btn-block"><em class="icon fab fa-google"></em><span>Google</span></a></li>
							</ul>
							<div class="ath-note text-center"> Don’t have an account? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#register-popup"> <strong>Sign up here</strong></a></div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .modal @e -->
		<!-- Modal @s -->
		<div class="modal fade" id="register-popup">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
					<div class="ath-container m-0">
						<div class="ath-body">

							<h5 class="ath-heading title">Sign Up <small class="tc-default">Create New {{$basic->sitename}} Account</small></h5>
							@if(isset($reference))
							<h5 class="ath-heading title"><small class="tc-default">
									You Were Referred By: {{$reference}} </small></h5> @endif

							<form method="POST" action="{{ route('register') }}">
								@csrf

								<div class="field-item">
									<div class="field-wrap">
										<input type="text" name="fname" value="{{ old('fname') }}" required class="input-bordered" placeholder="First Name">
									</div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input type="text" class="input-bordered" placeholder="Last Name" name="lname" required value="{{ old('lname') }}"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input type="text" name="username" value="{{ old('username') }}" required class="input-bordered" placeholder="Username"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input type="text" name="phone" required value="{{ old('phone') }}" class="input-bordered" placeholder="Phone Number"></div>
								</div>

								<div class="field-item">
									<div class="field-wrap"><input required type="email" name="email" value="{{ old('email') }}" class="input-bordered" placeholder="Email Address"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input required type="password" name="password" class="input-bordered" placeholder="Account Password"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input required type="password" name="password_confirmation" class="input-bordered" placeholder="Confirm Password"></div>
								</div>

								<input name="referBy" hidden @if(isset($reference)) value="{{$reference}}" @endif class="input-bordered" placeholder="Enter Referal Username">


								<div class="field-item"><input class="input-checkbox" id="agree-term-4" type="checkbox"><label for="agree-term-4">I agree to {{$basic->sitename}} <a href="{{url('/privacy')}}">Privacy Policy</a> &amp; <a href="{{url('/privacy')}}">Terms</a>.</label></div><button class="btn btn-primary btn-block btn-md">Sign Up</button>
							</form>
							<div class="sap-text"><span>Or Sign Up With</span></div>
							<ul class="btn-grp gutter-20px gutter-vr-20px">
								<li class="col"><a href="#" class="btn btn-md btn-facebook btn-block"><em class="icon fab fa-facebook-f"></em><span>Facebook</span></a></li>
								<li class="col"><a href="#" class="btn btn-md btn-google btn-block"><em class="icon fab fa-google"></em><span>Google</span></a></li>
							</ul>
							<div class="ath-note text-center"> Already have an account? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login-popup"> <strong>Sign in here</strong></a></div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .modal @e -->
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
		<script src="{{asset('front-assets/js/jquery.bundle.js?ver=192')}}"></script>
		<script src="{{asset('front-assets/js/scripts.js?ver=192')}}"></script>
		<script src="{{asset('front-assets/js/charts.js?var=161')}}"></script>

		@yield('script')
		<script src="{{asset('assets/admin/js/toastr.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/sweetalert.js')}}"></script>

		<script src="{{asset('front-assets/js/rainbow.js')}}"></script>
		<script src="{{asset('front-assets/js/sample.js')}}"></script>
		<script src="{{asset('front-assets/js/jquery.growl.js')}}"></script>

		<script src="{{asset('front-assets/js/pace.min.js')}}"></script>


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


		@if(Session::has('success'))
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
		@if(Session::has('danger'))
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
		@if(Session::has('ref'))
		<script>
			swal("Hello", "{!! session()->get('ref')  !!}", "info");
		</script>
		@endif
		@if(Session::has('referror'))
		<script>
			swal("Hello", "{!! session()->get('referror')  !!}", "error");
		</script>
		@endif



	</body>

</html>
<!-- Localized -->