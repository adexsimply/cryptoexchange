@extends('include.userdashboard')

@section('content')
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="main-content col-lg-12">
				<div class="content-area card">
					<div class="card-innr">
						<h4>READ BEFORE YOU PAY INTO OUR BANK ACCOUNT</h4>
						<ul class='list-group text-secondary'>
							<li class='notice list-group-item'>
								Do not pay below the {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}.
							</li>
							<li class="notice list-group-item">
								You are charged {{$basic->currency_sym}}{{number_format($basic->transcharge, $basic->decimal)}} Stamp Duty to the total amount payable.
							</li>
							<li class="notice list-group-item">
								To avoid funding delay, please write “First Name Transaction ID” e.g "Adewale G2N0001" as the Depositor Name if you are making payment via cash deposit or as a remark/memo if you are making payment via internet transfer, mobile transfer and other electronic means.
							</li>
							<li class="notice list-group-item">
								Payment must originate from your own bank account bearing the same registered names with {{$basic->sitename}}. Third-party payment via internet transfer, mobile transfer and other electronic means are not allowed. Third-party payment will be refunded with various charges applied and the reversal of third-party payment involves a lengthy process that can take several weeks.
							</li>
							<li class="notice list-group-item">
								We may request for more documents as a proof that the money was paid by yourself. So, you must be ready to submit them if they are requested.
							</li>
							<li class="notice list-group-item">
								Do not write any of these words “Bitcoin, Ethereum, Bitcoin Cash, Litecoin, Perfect Money, WebMoney, e-currency, digital currency, etc” as Depositors Name when making payment via cash deposit or as a Remark /Memo in case of internet transfer, mobile transfer and other electronic means. If you violate this term, your account will be BLOCKED.
							</li>
							<li class="notice list-group-item">
								{{$basic->sitename}} not be RESPONSIBLE for funding a wrong ACCOUNT or WALLET provided by you.
							</li>
							<li class="notice list-group-item">
								Ensure that you check and read the invoice page and your email regularly for our bank details as they may be changed any moment. Payment into any of our old/delisted accounts will not be treated
							</li>
							<li class="notice list-group-item">
								By proceeding to pay into our bank account, you agree to these terms.
							</li>
						</ul>
						<div class="token-overview-wrap">

							@if($data->gateway)
							<div class="token-overview">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="token-bonus token-bonus-sale"><span class="token-overview-title">Payment Method</span><span class="token-overview-value text-primary">Credit/Debit Card</span></div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="token-bonus token-bonus-samount"><span class="token-overview-title">Payment Gateway</span><span class="token-overview-value text-primary">{{App\Gateway::whereId($data->gateway)->first()->name}}</span></div>
									</div>
								</div>
							</div>

							@else
							<div class="token-overview">
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="token-bonus token-bonus-sale"><span class="token-overview-title">{{App\Bank::whereId($data->bank)->first()->name}}</span><span class="token-overview-value text-primary">Bank Name</span></div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="token-bonus token-bonus-samount"><span class="token-overview-title">{{App\Bank::whereId($data->bank)->first()->accname}}</span><span class="token-overview-value text-primary">Account Name</span></div>
									</div>
									<div class="col-md-4">
										<div class="token-total"><span class="token-overview-title font-bold">{{App\Bank::whereId($data->bank)->first()->account}}</span><span class="token-overview-value schedule-titl text-primary">Account Number</span></div>
									</div>
								</div>
							</div>
							@endif


							<div class="note note-plane note-danger note-sm pdt-1x pl-0">
								<p>Do not pay below {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}} After payment, click Confirm Payment button below and fill/upload your payment information.</p>
							</div>
						</div>




						<div class="pdb-1x">
							<h5 class="schedule-title"><span>Amount Payable</span></h5><span class="schedule-title text-secondary">
								@if($data->gateway == 103)
								USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
								@else
								{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
								@endif
							</span>
							<div class="pdb-1x">
								<h5 class="schedule-title"><span>What You Get</span></h5><span class="schedule-title text-secondary">

									@if($data->currency->symbol == "PM")
									{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}
									@else
									{{$data->currency->symbol}}{{number_format($data->getamo, 8)}}
									@endif</span>
								<br>


								@if($data->gateway == 107)
								<script src="https://js.paystack.co/v1/inline.js"></script>
								<button onclick="payWithPaystack()" class="btn btn-primary ">Pay With Paystack <em class="ti ti-credit-card"></em></button>
								<script>
									function payWithPaystack() {
										var handler = PaystackPop.setup({
											key: "{{App\Gateway::whereId($data->gateway)->first()->val1}}",
											email: "{{ Auth::user()->email }}",
											amount: "{{($data->main_amo)  * 100}}",
											currency: "NGN",
											ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
											firstname: '',
											lastname: '',
											// label: "Optional string that replaces customer email"
											metadata: {
												custom_fields: [{
													display_name: "Mobile Number",
													variable_name: "",
													value: "{{ Auth::user()->phone }}"
												}]
											},
											callback: function(response) {
												alert('Deposit successful. transaction refference number is ' + response.reference);
												window.location = 'javascript: submitform()';
											},
											onClose: function() {
												alert('window closed');
											}
										});
										handler.openIframe();
									}
								</script>
								<script type="text/javascript">
									function submitform() {
										document.forms["myform"].submit();
									}
								</script>
								<form id="myform" action="{{route('buy.paystack')}}" method="post">
									{{csrf_field()}}
									<input type="hidden" name="trx" value="{{ $data->trx }}" />
								</form>
								@elseif($data->gateway == 100)
								<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
								<button onclick="payWithRave()" class="btn btn-primary">Pay With Flutterwave <em class="ti ti-credit-card"></em></button>
								<script>
									const API_publicKey = "{{App\Gateway::whereId($data->gateway)->first()->val1}}";
									function payWithRave() {
										var x = getpaidSetup({
											PBFPubKey: API_publicKey,
											customer_email: "{{ Auth::user()->email }}",
											amount: "{{ round($data->main_amo, 2)}}",
											customer_phone: "{{ Auth::user()->mobile }}",
											currency: "NGN",
											txref: "rave-123456",
											payment_options: "card",
											meta: [{
												metaname: "flightID",
												metavalue: "AP1234"
											}],
											onclose: function() {},
											callback: function(response) {
												var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
												console.log("This is the response returned after a charge", response);
												if (
													response.tx.chargeResponseCode == "00" ||
													response.tx.chargeResponseCode == "0"
												) {
													window.location = 'javascript: submitform()';
												} else {
													// redirect to a failure page.
												}

												x.close(); // use this to close the modal immediately after payment.
											}
										});
									}
								</script>
								<script type="text/javascript">
									function submitform() {
										document.forms["myform"].submit();
									}
								</script>
								<form id="myform" action="{{route('buy.rave')}}" method="post">
									{{csrf_field()}}
									<input type="hidden" name="trx" value="{{ $data->trx }}" />
								</form>
								@elseif($data->gateway == 103)
								<button data-toggle="modal" data-target="#get-pay-address" class="btn btn-primary ">Pay With Stripe<em class="ti ti-credit-card"></em></button>
								<!-- Modal End -->
								<div class="modal fade" id="get-pay-address" tabindex="-1">
									<div class="modal-dialog modal-dialog-md modal-dialog-centered">
										<div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
											<div class="popup-body">
												<h4 class="popup-title">Pay With Stripe</h4>
												<p>Please Enter Your Credit Card Details Below. <strong>USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}</strong> will be charged from your card and <strong>{{$data->get_amount}} {{$data->currency->symbol}}</strong> will be credited to your <strong>{{$data->currency->name}} Wallet</strong> once we recevied payment.</p>
												<div class="gaps-1x"></div>
												<h6 class="font-bold">Name Written On Card</h6>
												<div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>
													<form role="form" id="payment-form" method="POST" action="{{ route('buy.stripe')}}">
														@csrf

														<input type="text" name="name" placeholder="Card Name" class="copy-address"><button class="copy-trigger copy-clipboard"><em class="ti ti-user"></em></button>
												</div>


												<div class="gaps-1x"></div>
												<h6 class="font-bold">Card Number</h6>
												<div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

													<input type="tel" name="cardNumber" placeholder="Valid Card Number" class="copy-address"><button class="copy-trigger copy-clipboard"><em class="ti ti-credit-card"></em></button>
												</div>


												<div class="gaps-1x"></div>
												<h6 class="font-bold">Card Expiry Date</h6>
												<div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

													<input type="tel" name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required class="copy-address"><button class="copy-trigger copy-clipboard"><em class="ti ti-calendar"></em></button>
												</div>

												<div class="gaps-1x"></div>
												<h6 class="font-bold">CCV</h6>
												<div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

													<input type="numbert" name="cardCVC" placeholder="CVC" class="copy-address"><button class="copy-trigger copy-clipboard"><em class="ti ti-credit-card"></em></button>
												</div>

												<!-- .copy-wrap -->
												<!-- .pay-info-list -->
												<div class="pdb-2-5x pdt-1-5x"><input type="checkbox" required class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong>{{$basic->sitename}} purchase aggrement &amp; payment terms</strong>.</label></div><button class="btn btn-primary" type="submit">Pay USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}<em class="ti ti-credit-card mgl-4-5x"></em></button></form>
												<div class="gaps-3x"></div>
												<div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
													<p>Ensure you have confirmed your {{$data->currency->name}} wallet address before proceeding with payment.</p>
												</div>
												<div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
													<p>{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong walletaddress.</p>
												</div>
											</div>
										</div><!-- .modal-content -->
									</div><!-- .modal-dialog -->
								</div><!-- Modal End -->
								@section('script')
								<script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>
								<script>
									(function($) {
										$(document).ready(function() {
											var card = new Card({
												form: '#payment-form',
												container: '.card-wrapper',
												formSelectors: {
													numberInput: 'input[name="cardNumber"]',
													expiryInput: 'input[name="cardExpiry"]',
													cvcInput: 'input[name="cardCVC"]',
													nameInput: 'input[name="name"]'
												}
											});
										});
									})(jQuery);
								</script>
								@stop
								@else
								<a href="#" data-toggle="modal" data-target="#pay-confirm"><span class="schedule-bonus">Confirm Payment</span></a>
								@endif
							</div>


						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>
</div><!-- .container -->
</div>

<!-- Modal End -->
<div class="modal fade" id="pay-confirm" tabindex="-1">
	<div class="modal-dialog modal-dialog-md modal-dialog-centered">
		<div class="modal-content">
			<div class="popup-body">
				<h4 class="popup-title">Confirm Your Payment</h4>
				<p class="lead text-primary">Your Order no. <strong>{{$data->trx}}</strong> has been placed successfully. </p>
				<p>The tokens balance will appear in your account only after you transaction has been confirmed and approved our team.</p>
				<p>To <strong>speed up verifcation</strong> proccesing please enter <strong>only vald accouNt number</strong> from where you’ll transferring your ethereum to our address.</p>


				<form role="form" method="POST" action="{{ route('ebuyupload') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<input name="trx" hidden value="{{$data->trx}}">
						<div class="col-md-6">
							<div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount Paid</label><input name="amount" placeholder="Enter Amount Paid" class="input-bordered" type="text"></div>
						</div>

						<div class="col-md-6">
							<div class="input-item input-with-label"><label class="input-item-label text-exlight">Depositor's Name</label><input placeholder="Enter Depositor's Name'" class="input-bordered" name="payer" type="text"></div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="input-item input-with-label"><label class="input-item-label text-exlight">Transaction Number</label><input name="tnum" placeholder="Enter Payment Trasaction NUmber " class="input-bordered" type="text"></div>
						</div>

						<div class="col-md-6">
							<div class="input-item input-with-label"><label for="nationality" class="input-item-label">Upload Payment Screenshot</label>
								<div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="photo" accept="image/*"><label for="file-01">Choose a file</label></div>
							</div>
						</div>
					</div>





					<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Select Payment Method</label>
						<select required class="select-bordered select-block" name="method">
							<option selected>Choose...</option>
							@foreach($method as $data)
							<option value="{{$data->id}}">{{$data->name}} </option>
							@endforeach
						</select>


					</div><!-- .input-item -->
					<ul class="d-flex flex-wrap align-items-center guttar-30px">
						<li><button type="submit" class="btn btn-primary">Confirm Payment</button>
				</form>
				</li>
				</ul>
				<div class="gaps-2x"></div>
				<div class="gaps-1x d-none d-sm-block"></div>
				<div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
					<p>You will be credited {{$data->getamo}} once your payment is confirmed.</p>
				</div>
				<div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
					<p>In case you send a different amount, please contact {{$basic->sitename}}, we will update accordingly.</p>
				</div>
			</div>
		</div><!-- .modal-content -->
	</div><!-- .modal-dialog -->
</div><!-- Modal End -->


@endsection