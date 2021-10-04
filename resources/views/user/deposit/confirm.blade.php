@extends('include.userdashboard')
@section('content')
<style>
  .error {
    color: red;
  }

  .acc {
    font-size: 16px;
    letter-spacing: 0.03em;
    margin-bottom: 0;
    text-transform: uppercase;
    font-weight: bolder
  }
</style>
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          @if($data->payment_method_id == "Bank Transfer")

          <div class="card-innr">
            <h4 class="card-title" id="dep_text">Deposit Transaction Preview</h4>
            <div class="text-right mt-2">
              <a href="{{ route('cancel-deposit',$data->trx) }}" onclick="return confirm('Are you sure you want to Cancelled this Deposit Transaction?')" class="btn btn-danger btn-between">Cancel Payment <em class="ti ti-wallet"></em></a>
            </div>

            <div id="confirm">
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 1</span>
                <h4 class="card-title"> Payment Preview</h4>
              </div>
              <div class="card-text">
                <p>You have opted to Deposit using <b style="color:#21a184">{{$data->payment_method_id}}</b>
                  Please find your pre-payment summary below.</p>
              </div>

              <div class="token-overview-wrap">
                <div class="token-overview">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="token-bonus token-bonus-sale"><span class="token-overview-title">Amount</span><span class="token-overview-value bonus-on-sale">{{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div>
                    </div>
                    <!-- <div class="col-md-4 col-sm-6">
                      <div class="token-bonus token-bonus-amount"><span class="token-overview-title">Deposit Charge</span><span class="token-overview-value bonus-on-amount">{{ $basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</span></div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="token-total"><span class="token-overview-title font-bold">Total Amount</span><span class="token-overview-value token-total-amount text-primary">{{ $basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</span></div>
                    </div>

                  </div>
                </div>
                <div class="note note-plane note-danger note-sm pdt-1x pl-0">
                  <p>Note: Do not pay below the Total Amount of {{ $basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</p>
                </div>
              </div>
              <hr>
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 2</span>
                <h4 class="card-title">Make Payment Using Bank Transfer </h4>
              </div>
              <div class="card-text">
                <p>Make Payment to the Account Details below using {{$data->method->name}} option as you've choosen. </p>
              </div>
              <div class="schedule-item">
                <div class="row mt-2">
                  <div class="col-xl-4 col-md-5 col-lg-6">
                    <div class="pdb-1x">
                      <h5 class="schedule-title">
                        <span">Bank Name</span>
                      </h5><span class="acc">{{$data->bank}}</span>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md col-lg-6">
                    <div class="pdb-1x">
                      <h5 class="schedule-title">
                        <span">Account Name</span>
                      </h5><span class="acc">{{$data->acc_name}}</span>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md col-lg-6">
                    <div class="pdb-1x">
                      <h5 class="schedule-title">
                        <span">Account Number</span>
                      </h5><span class="acc">{{$data->acc_num}}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="gaps-3x"></div>
              <hr>
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 3</span>
                <h4 class="card-title">Confirm Payment</h4>
              </div>
              <div class="card-text">
                <p>Click on the button below after making a successful transaction</p>
              </div>
              <div class="text-left mt-2">
                <button type="submit" onclick="proceed()" class="btn btn-primary btn-between">Proceed To Pay <em class="ti ti-wallet"></em></button>
              </div>
            </div>
            <div id="back_confirm" style="display:none">
              <div class="mt-3">
                <div class="">
                  <form method="POST" action="{{ route('confirm_deposit_save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                      <div class="input-item input-with-label">
                        <label class="input-item-label text-exlight">Transaction Number</label>
                        <input name="trans_number" class="input-bordered" type="text">
                        <label class="input-item-label text-exlight"><small> (Please enter your payment transaction number,)</small></label><br>
                        <label class="input-item-label text-exlight"><small>
                            @if ($errors->has('trans_number'))
                            <span class="error">
                              {{ $errors->first('trans_number') }}
                            </span><br>
                            @endif</small></label>
                        <br>
                      </div>

                      <input name="trx" value="{{$data->trx}}" hidden="">
                      <div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label>
                        <div class="relative"><em class="input-file-icon fas fa-upload"></em>
                          <input type="file" name="prove" required class="input-file" id="file-01" accept="image/*"><label for="file-01">Choose a file</label>
                        </div>
                        <label><small> (Please attach a screenshot of your bank transfer of payment slip)</small></label><br>
                        <label><small>
                            @if ($errors->has('prove'))
                            <span class="error">
                              {{ $errors->first('prove') }}
                            </span><br>
                            @endif</small></label>
                      </div>
                      <button type="submit" class="btn btn-primary btn-between">Confirm Payment</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="text-left mt-3">
                <a href="#" class="mt-3" onclick="back()"><span class="schedule-bonus" style="color: grey;">Back To Payment Details</span></a>
              </div>
            </div>
            <div class="pay-notes">
              <div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em>
                <p>Fund will appear in your account after payment successfully made. </p>
              </div>
            </div>
          </div>
          @endif
          @if($data->payment_method_id == "Online Payment")

          <div class="card-innr">
            <h4 class="card-title" id="dep_text">Deposit Transaction Preview</h4>
            <div class="text-right mt-2">
              <a href="{{ route('cancel-deposit',$data->trx) }}" onclick="return confirm('Are you sure you want to Cancelled this Deposit Transaction?')" class="btn btn-danger btn-between">Cancel Payment <em class="ti ti-wallet"></em></a>
            </div>

            <div id="confirm">
              <div class="card-head">
                <h4 class="card-title"> Payment Preview</h4>
              </div>
              <div class="card-text">
                <p>You have opted to Deposit using <b style="color:#21a184">{{$data->payment_method_id}} (Credit/Debit Card)</b>
                  Please find your pre-payment summary below.</p>
              </div>

              <div class="token-overview-wrap">
                <div class="token-overview">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="token-bonus token-bonus-sale"><span class="token-overview-title">Amount</span><span class="token-overview-value bonus-on-sale">{{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div>
                    </div>
                    <!-- <div class="col-md-4 col-sm-6">
                      <div class="token-bonus token-bonus-amount"><span class="token-overview-title">Deposit Charge</span><span class="token-overview-value bonus-on-amount">{{ $basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</span></div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="token-total"><span class="token-overview-title font-bold">Total Amount</span><span class="token-overview-value token-total-amount text-primary">{{ $basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</span></div>
                    </div>

                  </div>
                </div>
              </div>
              <hr>
              <div class="text-left mt-2">
                <!-- <button type="submit" onclick="proceed()" class="btn btn-primary btn-between">Proceed To Pay <em class="ti ti-wallet"></em></button> -->
                <!-- {{$gate}} -->
                @if($data->gateway->id == "107")
                <script src="https://js.paystack.co/v1/inline.js"></script>
                <button onclick="payWithPaystack()" class="btn btn-primary ">Pay With Paystack <em class="ti ti-credit-card"></em></button>
                <script>
                  function payWithPaystack() {
                    var handler = PaystackPop.setup({
                      key: "{{$gate->val1}}",
                      email: "{{ Auth::user()->email }}",
                      amount: "{{($data->amount+$data->charge) * 10}}" + 00,
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
                <form id="myform" action="{{route('paystack_save')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="trx" value="{{ $data->trx }}" />
                </form>
                @elseif($data->gateway->id == "100")
                <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                <button onclick="payWithRave()" class="btn btn-primary">Pay With Flutterwave <em class="ti ti-credit-card"></em></button>
                <script>
                  const API_publicKey = "{{$gate->val1}}";

                  function payWithRave() {
                    var x = getpaidSetup({
                      PBFPubKey: API_publicKey,
                      customer_email: "{{ Auth::user()->email }}",
                      amount: "{{ round($data->amount+$data->charge, 2)}}",
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
                <form id="myform" action="{{route('rave_save')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="trx" value="{{ $data->trx }}" />
                </form>
                @elseif($data->gateway->id == "103")
                <button data-toggle="modal" data-target="#get-pay-address" class="btn btn-primary ">Pay With Stripe <em class="ti ti-credit-card"></em></button>
                <!-- Modal End -->
                <div class="modal fade" id="get-pay-address" tabindex="-1">
                  <div class="modal-dialog modal-dialog-md modal-dialog-centered">
                    <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                      <div class="popup-body">
                        <h4 class="popup-title">Pay With Stripe</h4>
                        <p>Please Enter Your Credit Card Details Below. <strong>{{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</strong>will be credited to your <strong> Naira Wallet</strong> once the payment is successful.</p>
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
                          <input type="number" name="cardNumber" placeholder="Card Number" pattern="[/^([0-9]{4}$/]" class="copy-address">
                          <button class="copy-trigger copy-clipboard"><em class="ti ti-credit-card"></em></button>
                        </div>
                        <div class="gaps-1x"></div>
                        <h6 class="font-bold">Card Expiry Date</h6>
                        <div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>
                          <input type="number" name="cardExpiry" placeholder="MM / YYYY" required class="copy-address">
                          <button class="copy-trigger copy-clipboard"><em class="ti ti-calendar"></em></button>
                        </div>

                        <div class="gaps-1x"></div>
                        <h6 class="font-bold">CCV</h6>
                        <div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>
                          <input type="number" name="cardCVC" placeholder="CVC" class="copy-address"><button class="copy-trigger copy-clipboard"><em class="ti ti-credit-card"></em></button>
                        </div>

                        <!-- .copy-wrap -->
                        <!-- .pay-info-list -->
                        <div class="pdb-2-5x pdt-1-5x"><input type="checkbox" required class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong>{{$basic->sitename}} purchase aggrement &amp; payment terms</strong>.</label></div>
                        <button class="btn btn-primary" type="submit">Pay {{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}<em class="ti ti-credit-card mgl-4-5x"></em></button></form>
                        <div class="gaps-3x"></div>
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
            <div class="pay-notes">
              <div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em>
                <p>Fund will appear in your account after payment successfully made. </p>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<script>
  function proceed() {
    document.getElementById("dep_text").textContent = 'Deposit Confirmation Form';
    var div = document.getElementById("confirm");
    div.style.display = 'none';
    var div = document.getElementById("back_confirm");
    div.style.display = 'block';
  }

  function back() {
    document.getElementById("dep_text").textContent = 'Deposit Transaction Preview';
    var div = document.getElementById("back_confirm");
    div.style.display = 'none';
    var div = document.getElementById("confirm");
    div.style.display = 'block';
  }
</script>