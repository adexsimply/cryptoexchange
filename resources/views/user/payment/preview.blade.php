@extends('include.userdashboard')
@section('content')
 <div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12">

<div class="content-area card"><div class="card-innr">

<div class="content-area card"><div class="card-innr"><div class="card-head"><span class="card-sub-title text-primary font-mid">Step 2</span><h4 class="card-title">Payment Preveiw</h4></div><div class="card-text"><p>You have opted to deposit using  @if($data->gateway_id == 0)
Bank Transfer
@else
{{App\Gateway::whereId($data->gateway_id)->first()->name}}.
@endif
 Please find your pre-payment summary below.</p></div>


<div class="token-overview-wrap"><div class="token-overview"><div class="row"><div class="col-md-3 col-sm-6"><div class="token-bonus token-bonus-sale"><span class="token-overview-title">Amount</span><span class="token-overview-value bonus-on-sale">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div></div><div class="col-md-3 col-sm-6"><div class="token-bonus token-bonus-amount"><span class="token-overview-title">Deposit Charge</span><span class="token-overview-value bonus-on-amount">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</span></div></div><div class="col-md-3"><div class="token-total"><span class="token-overview-title font-bold">Total Amount</span><span class="token-overview-value token-total-amount text-primary">{{$basic->currency_sym}}{{number_format($data->charge + $data->amount, $basic->decimal)}}</span></div></div>

<div class="col-md-3"><div class="token-total"><span class="token-overview-title font-bold">USD Amount</span><span class="token-overview-value token-total-amount text-primary">${{number_format($data->usd, $basic->decimal)}}</span></div></div>

</div></div><div class="note note-plane note-danger note-sm pdt-1x pl-0"><p>Your total deposit will be calculated based on exchange rate at the moment your transaction is confirm if you are depositing using cryptocurrency.</p></div></div><div class="card-head"><span class="card-sub-title text-primary font-mid">Step 3</span>


<h4 class="card-title">Make Payment Using @if($data->gateway_id == 0) Bank Transfer @else{{App\Gateway::whereId($data->gateway_id)->first()->name}}@endif</h4></div>


@if($data->gateway_id == 0)
<div class="card-text"><p>Make Payment To Any f The Following Account Numbers. </p></div>
<? $bank = DB::table('banks')->orderBy('name','asc')->get(); ?>
<div class="gaps-3x"></div><div class="card-head"><h5 class="card-title card-title-md">Bank Account(s)</h5></div>
@foreach($bank as $gate)

<div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Bank Name</span></h5><span>{{$gate->name}}</span></div></div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Account Details</span></h5><span>{{$gate->account}}</span></div></div>
</div></div>

@endforeach


@elseif($data->gateway_id == 513)
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


To complete deposit, please select a cryptocurrency and proceed with your deposit. You will be redirected to Coin Payments page for your secure crypto payment process.
<select name="currency" required class="select-bordered select-block" data-placeholder="Select A Cryptocurrency">
														<option>

															<option value="BTC">BTC (BitCoin) </option>
                                                            <option value="BCH">Bitcoin Cash (BCH) </option>
                                                            <option value="LTC">LiteCoin (LTC) </option>
                                                            <option value="ETH">Ethereum (ETH) </option>
                                                            <option value="ZEC">Zcash (ZEC) </option>
                                                            <option value="DASH">Dash (DASH) </option>
                                                            <option value="XRP">Ripple (XRP) </option>
                                                            <option value="XMR">Monero (XMR) </option>
                                                            <option value="NEO">NEO (NEO) </option>
                                                            <option value="ADA">Cardano (ADA) </option>
                                                            <option value="EOS">EOS (EOS) </option>
													</optgroup>
													</select>

@else
<div class="card-text"><p>To complete deposit please make you payment. You can send payment directly to our address or you may pay online. Once you paid, you will receive an email about the successfull deposit and fund will be credited into your wallet. </p></div>
@endif

<div class="pay-buttons"><div class="pay-button">
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

@if($data->gateway_id == 0)
  <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Transaction Number</label><input   name="code" class="input-bordered" required type="text"><label class="input-item-label text-exlight"><small> (Please enter your payment transaction number,)</small></label></div>

<input name="bank" value="bank" hidden >


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"><label for="file-01">Choose a file</label>
</div>
<small> (Please attach a screenshot of your bank transfer of payment slip)</small>
</div></div>
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button>
</form
@endif


@if($data->gateway_id == 100)
<badge  onClick="payWithRave()" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 107)
<script src="https://js.paystack.co/v1/inline.js"></script>
<badge onclick="payWithPaystack()" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 109)
<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
<badge onclick="makePayment()"  class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@else
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button>
</form>@endif




</div><div class="pay-button-sap">or</div><div class="pay-button"><a href="{{route('deposit')}}" class="btn btn-danger btn-between w-100">Cancel <em class="ti ti-arrow-right"></em></a></div></div><div class="pay-notes"><div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em><p>Fund will appear in your account after payment successfully made. </div></div></div> <!-- .card-innr --></div> <!-- .content-area --></div></div><!-- .page-content -->

@section('js')
 @if($data->gateway_id == 107)
        <script>
						function payWithPaystack(){
						var handler = PaystackPop.setup({
						key: "{{ $data->gateway->val1 }}",
						email: "{{ Auth::user()->email }}",
						amount: "{{ round($data->amount+$data->charge, 2)*100 }}",
						currency: "NGN",
						ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
						firstname: '',
						lastname: '',
						// label: "Optional string that replaces customer email"
						metadata: {
						custom_fields: [
						{
						display_name: "Mobile Number",
						variable_name: "",
						value: "+2348012345678"
						}
						]
						},
						callback: function(response){
						alert('Deposit successful. transaction refference number is ' + response.reference);
						window.location='javascript: submitform()';
						},
						onClose: function(){
						alert('window closed');
						}
						});
						handler.openIframe();
						}
						</script>


                    <script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>@section('js')
 @elseif($data->gateway_id == 109)
      <script>
					function makePayment() {
					  var paymentEngine = RmPaymentEngine.init({
					     key: "{{ $data->gateway->val1 }}",
					      customerId: "{{ Auth::user()->id }}",
					      firstName: "{{ Auth::user()->fname }}",
					      lastName: "{{ Auth::user()->lname }}",
					      email: "{{ Auth::user()->email }}",
					      narration: "{{ $data->trx }}",
					      amount: "{{ round($data->amount+$data->charge, 2)*1 }}",
					      onSuccess: function (response) {
					      window.location='javascript: submitform()';
					      },
					      onError: function (response) {
					      console.log('callback Error Response', response);
					      },
					      onClose: function () {
					      console.log("closed");
					      }
					      });
					      paymentEngine.showPaymentWidget();
					    }
					</script>

                    <script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>
    @elseif($data->gateway_id == 100)
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <script>
			const API_publicKey = "{{ $data->gateway->val1 }}";
			function payWithRave() {
			var x = getpaidSetup({
			PBFPubKey: API_publicKey,
			customer_email: "{{ Auth::user()->email }}",
			amount: "{{ round($data->amount, 2)}}",
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
			window.location='javascript: submitform()';
			} else {
			// redirect to a failure page.
			}

			x.close(); // use this to close the modal immediately after payment.
			}
			});
			}
			</script>
			<script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>
    @elseif($data->gateway_id == 108)
        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            closedFunction = function () {

            }
            successFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/success';
            }
            failedFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/error';
            }

            function pay(item, price) {
                //Initiate voguepay inline payment
                Voguepay.init({
                    v_merchant_id: "{{ $data->gateway->val1 }}",
                    total: price,
                    notify_url: "{{ route('ipn.voguepay') }}",
                    cur: 'USD',
                    merchant_ref: "{{ $data->trx }}",
                    memo: 'Buy ICO',
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5af93ca2913fd',
                    store_id: "{{ $data->user_id }}",
                    custom: "{{ $data->trx }}",

                    closed: closedFunction,
                    success: successFunction,
                    failed: failedFunction
                });
            }

            $(document).ready(function () {
                $(document).on('click', '#btn-confirm', function (e) {
                    e.preventDefault();
                    pay('Buy', {{ $data->usd }});
                });
            })
        </script>

    @endif
@endsection

<script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}">
            </form>

@endsection
