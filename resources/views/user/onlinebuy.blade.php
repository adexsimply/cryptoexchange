@extends('include.userdashboard')

@section('content')
<div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12"> <div class="content-area card"><div class="card-innr"><div class="card-head"><span class="card-sub-title text-primary font-mid">Buy {{$data->currency->name}}</span><h4 class="card-title">Purchase Preview</h4></div><div class="card-text"><p>Find below the summary of your {{$data->currency->name}} purchase. {{$basic->sitename}} will not be liable to any loss arising from wrong wallet address, or reduction in {{$data->currency->name}} price rate.</p></div>



<div class="token-contribute"><em class="cf cf-{{$data->currency->icon}} text-primary"></em> Curent {{$data->currency->name}} Exchange Rate.
<div class="token-calc"><div class="token-pay-amount"><input id="token-base-amount" class="input-bordered input-with-hint" readonly type="text" value="1"><div class="token-pay-currency"><a href="#" class="link ucap link-light toggle-tigger toggle-caret">{{$data->currency->name}}</a></div></div><div class="token-received"><div class="token-eq-sign">=</div><div class="token-received-amount"><h5 class="token-amount">{{$basic->currency_sym}}{{number_format($data->currency->price*$basic->rate, $basic->decimal)}}</h5><div class="token-symbol"></div></div></div></div>


<div class="note note-plane note-light mgb-1x"><em class="fas fa-wallet"></em><p>Your receiving {{$data->currency->name}}  wallet address: <strong> <a href="#">{{App\Cryptowallet::whereCoin_id($data->currency_id)->first()->address}}.</strong></a>.</p></div>

<div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>To change your wallet address or to receive into another <strong id="name7"></strong> wallet, <a href="{{route('wallet')}}">Click Here</a>.</p></div>

</div><div class="token-overview-wrap"><div class="token-overview"><div class="row"><div class="col-md-3 col-sm-6"><div class="token-bonus token-bonus-sale"><span class="token-overview-title">Amount To Buy Bonus</span><span class="token-overview-value bonus-on-sale">{{$basic->currency_sym}}{{number_format($data->enter_amount, $basic->decimal)}}</span></div></div><div class="col-md-3 col-sm-6"><div class="token-bonus token-bonus-amount"><span class="token-overview-title">Purchase Charges Bonus</span><span class="token-overview-value bonus-on-amount">{{$basic->currency_sym}}{{number_format($data->buy_charge, $basic->decimal)}}</span></div></div><div class="col-md-3 col-sm-6"><div class="token-total"><span class="token-overview-title font-bold">Amount To Pay</span><span class="token-overview-value token-total-amount text-primary">{{$basic->currency_sym}}{{number_format($data->enter_amount, $basic->decimal)}}</span></div></div>
<div class="col-md-3 col-sm-6"><div class="token-total"><span class="token-overview-title font-bold">What You Get</span><span class="token-overview-value token-total-amount text-primary">{{$data->get_amount}}{{$data->currency->symbol}}</span></div></div>



</div></div><div class="note note-plane note-danger note-sm pdt-1x pl-0"><p>Your {{$data->currency->name}} purchase will be calculated based on exchange rate at the moment your transaction is confirmed.</p></div></div><div class="pay-buttons pt-0"><div class="pay-button">

@if($data->gateway == 107)
<script src="https://js.paystack.co/v1/inline.js"></script>
<button  onclick="payWithPaystack()" class="btn btn-primary btn-between w-100">Pay With Paystack <em class="ti ti-credit-card"></em></button>


<script>
function payWithPaystack(){
var handler = PaystackPop.setup({
key: "{{App\Gateway::whereId($data->gateway)->first()->val1}}",
email: "{{ Auth::user()->email }}",
amount: "{{($data->enter_amount)  * 100}}",
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
						value: "{{ Auth::user()->phone }}"
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
			<form id="myform"  action="{{route('buy.paystack')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			</form>


@elseif($data->gateway == 100)
 <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<button  onclick="payWithRave()" class="btn btn-primary btn-between w-100">Pay With Flutterwave <em class="ti ti-credit-card"></em></button>



    <script>
			const API_publicKey = "{{App\Gateway::whereId($data->gateway)->first()->val1}}";
			function payWithRave() {
			var x = getpaidSetup({
			PBFPubKey: API_publicKey,
			customer_email: "{{ Auth::user()->email }}",
			amount: "{{ round($data->enter_amount, 2)}}",
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
			<form id="myform"  action="{{route('buy.rave')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			</form>


@elseif($data->gateway == 999)

<? $bank = DB::table('banks')->orderBy('name','asc')->get(); ?>
<div class="gaps-3x"></div><div class="card-head"><h5 class="card-title card-title-md">Bank Account(s)</h5></div>
@foreach($bank as $gate)

<div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Bank Name</span></h5><span>{{$gate->name}}</span></div></div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Account Details</span></h5><span>{{$gate->account}}</span></div></div>
</div></div>

@endforeach

<form id="myform"  action="{{route('buy.bank')}}" method="post"  enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{$data->trx}}" />

  <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Transaction Number</label><input   name="trxx" class="input-bordered" required type="text"><label class="input-item-label text-exlight"><small> (Please enter your payment transaction number,)</small></label></div>


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"><label for="file-01">Choose a file</label>
</div>
<small> (Please attach a screenshot of your bank transfer of payment slip)</small>
</div></div>
<button  type="submit" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button></form>
@elseif($data->gateway == 103)
<button  data-toggle="modal" data-target="#get-pay-address" class="btn btn-primary btn-between w-100">Pay With Stripe<em class="ti ti-credit-card"></em></button>

<!-- Modal End --><div class="modal fade" id="get-pay-address" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body"><h4 class="popup-title">Pay With Stripe</h4><p>Please Enter Your Credit Card Details Below.  <strong>{{$basic->currency}}{{($data->enter_amount + $data->buy_charge)  * 1}}</strong> will be charged from your card and <strong>{{$data->get_amount}} {{$data->currency->symbol}}</strong> will be credited to your <strong>{{$data->currency->name}} Wallet</strong> once we recevied payment.</p><div class="gaps-1x"></div><h6 class="font-bold">Name Written On Card</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>
<form role="form" id="payment-form" method="POST" action="{{ route('buy.stripe')}}">
@csrf

<input type="text" name="name" placeholder="Card Name" class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-user"></em></button></div>


<div class="gaps-1x"></div><h6 class="font-bold">Card Number</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="tel" name="cardNumber" placeholder="Valid Card Number" class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-credit-card"></em></button></div>


<div class="gaps-1x"></div><h6 class="font-bold">Card Expiry Date</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="tel" name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required  class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-calendar"></em></button></div>

<div class="gaps-1x"></div><h6 class="font-bold">CCV</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="numbert"  name="cardCVC"  placeholder="CVC"  class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-credit-card"></em></button></div>

<!-- .copy-wrap --><!-- .pay-info-list --><div class="pdb-2-5x pdt-1-5x"><input type="checkbox"  required class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong>{{$basic->sitename}} purchase aggrement &amp; payment terms</strong>.</label></div><button class="btn btn-primary" type="submit">Pay {{$basic->currency}}{{$data->enter_amount + $data->buy_charge}} <em class="ti ti-credit-card mgl-4-5x"></em></button></form><div class="gaps-3x"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>Ensure you have confirmed your {{$data->currency->name}} wallet address before proceeding with payment.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong walletaddress.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->



@section('script')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
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
@endif


</div></div><div class="pay-notes"><div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em><p>Your {{$data->currency->name}} will appear in your {{$data->currency->name}} wallet after payment is successfully made and approved by our server. </p></div></div></div> <!-- .card-innr --></div> <!-- .content-area --></div><!-- .col --><div class="aside sidebar-right col-lg-4"><!-- .container --></div><!-- .container --></div><!-- .page-content -->@endsection
