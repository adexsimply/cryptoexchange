@extends('include.userdashboard')
@section('content')
<style>
  .error {
    color: red;
  }
</style>
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="">
              <div class="popup-body">
                <div class="card-head">
                  <h4 class="card-title" style="font-size:35px !important">Deposit</h4>
                </div>
                <h4 class="popup-title">Fund Your Naira Wallet</h4>
                <p class="lead">You currently have <span><b>{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</b></span> in your Naira Wallet. Fill the form below to proceed.</p>
                <p>You can choose any of following payment method to fund your wallet. The fund will appear in your account after successfull payment.</p>
                <p><span><b>Note: The minimum amount you can deposit is ₦20,000</b></span></p>
                <p><span><b>Note: A service charge of ₦1,000 applies</b></span></p>
                <form method="POST" action="{{ route('make_deposit_now') }}">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-item input-with-label">
                        <h5 class="mgt-1-5x font-mid">Select payment method:</h5>
                        <select onchange="showDiv()" class="select-bordered select-block" id="payment_method" name="payment_method">
                          <option value="" selected>Choose...</option>
                          <option value="Bank Transfer" @if (old("payment_method")=="Bank Transfer" ) selected @endif>Bank Transfer </option>
                          <!-- <option value="Online Payment" @if (old("payment_method")=="Online Payment" ) selected @endif>Online Payment </option> -->
                        </select>
                        @if ($errors->has('payment_method'))
                        <span class="error">
                          {{ $errors->first('payment_method') }}
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div id="divBank Transfer" style="display:none;">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-item input-with-label">
                          <h5 class="mgt-1-5x font-mid">Payment Method</h5>
                          <select class="select-bordered select-block" name="method">
                            <option selected value="">Choose...</option>
                            @foreach($method as $data)
                            <option value="{{$data->id}}" @if (old('method')==$data->id) selected @endif>{{$data->name}} </option>
                            @endforeach
                          </select>
                          @if ($errors->has('method'))
                          <span class="error">
                            {{ $errors->first('method') }}
                          </span>
                          @endif
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="input-item input-with-label">
                          <h5 class="mgt-1-5x font-mid">Select Bank</h5>
                          <select class="select-bordered select-block" name="bank">
                            <option selected value="">Choose...</option>
                            @foreach($bank as $data)
                            <option value="{{$data->id}}" @if (old('bank')==$data->id) selected @endif>{{$data->name}} </option>
                            @endforeach
                          </select>
                          @if ($errors->has('bank'))
                          <span class="error">
                            {{ $errors->first('bank') }}
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="divOnline Payment" style="display:none;">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-item input-with-label">
                          <h5 class="mgt-1-5x font-mid">Select Payment Gateway</h5>
                          <select class="select-bordered select-block" name="gateway">
                            <option selected value="">Choose...</option>
                            @foreach($gates as $data)
                            <option value="{{$data->id}}" @if (old('gateway')==$data->id) selected @endif>{{$data->name}} </option>
                            @endforeach
                          </select>
                          @if ($errors->has('gateway'))
                          <span class="error">
                            {{ $errors->first('gateway') }}
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- <div class="col-6">
                      <h5 class="mgt-1-5x font-mid">Amount IN USD ($):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input type="number" name="usd" id="usd" class="copy-address" onkeyup="" value="{{ old('usd') }}" placeholder="$20">
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <h5 class="mgt-1-5x font-mid">Amount IN {{$basic->currency}} ({{$basic->currency_sym}}):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input value="{{$basic->rate}}" type="hidden" id="rate">
                        <input required="" type="number" name="amount" id="naira" class="copy-address" value="{{ old('amount') }}" placeholder="{{$basic->currency_sym}}0.00">
                        <!-- <input type="hidden" name="amount" id="naira_amount" value="{{ old('amount') }}" readonly> -->
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                      @if ($errors->has('amount'))
                      <span class="error">
                        {{ $errors->first('amount') }}
                      </span><br>
                      @endif
                      <span class="text-light font-italic mgb-2x"><small>* Payment gateway company may charge you a processing fee.</small></span>
                    </div>
                  </div>

                  <div class="pdb-2-5x pdt-1-5x">
                    <input type="checkbox" name="terms" class="input-checkbox input-checkbox-md" id="agree-term-3" @if (old('terms')=='on' ) checked @endif>
                    <label for="agree-term-3">I hereby agree to the <strong>PM247crypto agreement &amp; deposit terms term</strong>.</label>
                    <div class="p">
                      @if ($errors->has('terms'))
                      <span class="error">
                        {{ $errors->first('terms') }}
                      </span><br>
                      @endif
                    </div>
                  </div>
                  <ul class="d-flex flex-wrap align-items-center guttar-30px">
                    <li><button type="submit" class="btn btn-primary">Accept &amp; Process Payment <em class="ti ti-arrow-right mgl-2x"></em></button></li>
                  </ul>
                  <div class="gaps-2x"></div>
                  <div class="gaps-1x d-none d-sm-block"></div>
                  <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                    <p class="text-light">You will automatically redirect for payment after your order placing.</p>
                  </div>
                </form>
              </div>
            </div>
          </div><!-- .container -->
        </div><!-- .page-content -->
        <script>
          function showDiv() {
            var value = payment_method.value
            console.log(value)
            if (value == "Bank Transfer") {
              displayDiv("divBank Transfer");
              hideDiv("divOnline Payment");
            }
            if (value == "Online Payment") {
              displayDiv("divOnline Payment");
              hideDiv("divBank Transfer");
            }
            if (value == "") {
              hideDiv("divOnline Payment");
              hideDiv("divBank Transfer");
            }
          }

          function displayDiv(prefix) {
            console.log(prefix)
            var div = document.getElementById(prefix);
            div.style.display = 'block';
          }

          function hideDiv(prefix) {
            console.log(prefix)
            var div = document.getElementById(prefix);
            div.style.display = 'none';
          }

          window.onload = showDiv();

          function myFunction() {
            var rate = $('#rate').val();
            var usd = $('#usd').val();
            var amount = rate * usd;
            //console.log(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
            if (amount > 0) {
              document.getElementById("naira_amount").value = amount;
              document.getElementById("naira").value = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
          };
        </script>
        @endsection