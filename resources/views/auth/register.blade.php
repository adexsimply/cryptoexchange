<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""><!-- Fav Icon  -->
	<link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}"><!-- Site Title  -->
	<title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title><!-- Bundle and Base CSS -->
	<link rel="stylesheet" href="{{asset('front-assets/css/vendor.bundle-11966.css')}}">
	<link rel="stylesheet" href="{{asset('front-assets/css/style-salvia-11966.css')}}" id="changeTheme">
	<link href="{{asset('assets/admin/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet" />
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->

	<link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />
	<script src="{{asset('process/countries.js')}}"></script>
	<!-- Extra CSS -->
	<link rel="stylesheet" href="{{asset('front-assets/css/theme-11966.css')}}">
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

<body class="nk-body body-wider mode-onepage" style="background-color: #024C5D !important">

	<body class="nk-body body-wider container" style="background-color: #024C5D !important">
		<div class="nk-wrap row">
			<main class="nk-pages nk-pages-centered col-lg-6 offset-lg-3" style="background-color: #024C5D !important">
				<div class=" col-lg-12 ath-container">
					<div class="ath-header text-center">
						<center><a href="{{url('/')}}" class="logo-link"><img class="logo-dark" src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" width="70" alt="logo"><img class="logo-light" src="{{asset('assets/images/logo/logo.png')}}" srcset="{{asset('assets/images/logo/logo.png')}}" width="70 alt=" logo"></a></center>
					</div>
					<div class="ath-body ">
						<h5 class="ath-heading title">Signup <small class="tc-default">Fill the form below to create a new {{$basic->sitename}} account</small></h5>@if(isset($reference))
						<h5 class="ath-heading title"><small class="tc-default">
								You Were Referred By: {{$reference}} </small></h5> @endif


						<bold class='notice text-center'>Important Notice:</bold>
						<small class='notice'>
							<ol class='instruction text-danger'>
								<li class=''>Your First Name and Other Names must be real and same as the names in your personal bank account.</li>
								<li class=''>You must use your real, complete and verifiable address, else your account may be blocked.</li>
								<li class=''>Select your country and write country code in front of your phone number, else you will not receive verification code. e.g: +2348012345678.</li>
								<li>
									Please use secure password and do not give it to anyone, not even our staff. We will never ask for it.
								</li>
							</ol>

							<style>
								#error {
									color: red;
								}

								.error {
									color: red;
								}

								.abir {
									display: fixed;
									z-index: 299;
									position: absolute;
									/*width: 85%;*/
									color: #FFF;
									background-color: #26a1ab;
									border-color: #26a1ab;
								}

								.slow-spin {
									-webkit-animation: fa-spin 2s infinite linear;
									animation: fa-spin 2s infinite linear;
								}
							</style>
							<form method="POST" action="{{ route('register') }}">
								@csrf
								<br>
								<h6 class="ath-heading tsitle">Personal Details</h6>
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
									<div class="field-wrap"><input required type="email" name="email" value="{{ old('email') }}" class="input-bordered" placeholder="Email Address"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input required type="password" name="password" class="input-bordered" placeholder="Account Password"></div>
								</div>
								<div class="field-item">
									<div class="field-wrap"><input required type="password" name="password_confirmation" class="input-bordered" placeholder="Confirm Password"></div>
								</div>


								<div class="field-item">
									<div class="field-wrap"><input required type="date" name="dob" class="input-bordered" placeholder="Date Of Birth"><small>Date of Birth</small></div>
								</div>

								<br>
								<h6 class="ath-heading tsitle">Gender</h6>
								<div class="field-item">
									<div class="field-wrap">
										<div class="field-wrap"><select name="gender" class="select" data-select2-theme="bordered" required>
												<option value="">Please Select Gender</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select></div>
									</div>
								</div>

								<br>
								<h6 class="ath-heading tsitle">Contact Details</h6>
								<div class="field-item">
									<div class="field-wrap"><input type="text" name="phone" required value="{{ old('phone') }}" class="input-bordered" placeholder="Phone Number"></div>
								</div>

								<!-- <div class="field-item">
									<div class="field-wrap">
										<small>Country of Residence</small>
										<select onchange="print_state('state', this.selectedIndex);" id="country" required name="country" class="select" data-select2-theme="bordered" /></select>

										<script language="javascript">
											print_country("country");
										</script>
									</div>
								</div> -->

								<!-- <div class="field-item">
									<div class="field-wrap">
										<small>State of Residence</small>
										<select name="state" required id="state" class="select" data-select2-theme="bordered">
											<option value="">Select state</option>
										</select>

									</div>
								</div> -->

								<br>
								<h6 class="ath-heading tsitle">Home Address</h6>
								<div class="field-item">
									<div class="field-wrap"><textarea type="text" name="address" required value="{{ old('address') }}" class="input-bordered" placeholder="Home Address"></textarea></div>
								</div>

								@if(isset($reference))
								<input name="referBy" readonly @if(isset($reference)) value="{{$reference}}" @endif class="input-bordered" placeholder="Enter Referal Username">
								@endif

								<hr>
								<div class="field-item"><input class="input-checkbox" id="agree-term-4" type="checkbox"><label for="agree-term-4">I agree to {{$basic->sitename}} <a href="{{url('/privacy')}}">Privacy Policy</a> &amp; <a href="{{url('/privacy')}}">Terms</a>.</label></div>
								<div id="working"><button class="btn btn-primary btn-block btn-md">Sign Up</button></div>
							</form>
					</div>
					<div class="ath-note text-center tc-light">Already have an account? <a href="{{ route('login') }}"> <strong>Sign in here</strong></a></div>
				</div>
			</main>
		</div>
		<div class="preloader"><span class="spinner spinner-round"></span></div><!-- JavaScript -->

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
		<script>
			$('document').ready(function() {
				/* validation */
				$("#reg-form").validate({
					rules: {
						password: {
							required: true,
						},
						username: {
							required: true,
						},
					},
					messages: {
						password: "<span style='color: red'>Password is required.</span>",
						username: "<span style='color: red'>Username is required.</span>",
					},
					submitHandler: submitForm
				});
				/* validation */


			});
		</script>


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