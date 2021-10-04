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
                  <h4 class="card-title" style="font-size:35px !important">Withdraw</h4>
                </div>
                <h4 class="popup-title">Withdraw From Your Naira Wallet</h4>
                <p class="lead">You currently have <span><b>{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</b></span> in your Naira Wallet. Fill the form below to proceed.</p>
                <p>Specify the amount you want to withdraw. The fund will appear in your account after it has been confirmed.</p>
                <p><span><b>Note: The minimum amount you can withdraw is ₦20,000</b></span></p>
                <p><span><b>Note: A service charge of ₦1,000 applies</b></span></p>
                <form method="POST" action="{{ route('withdraw_fund') }}">
                  @csrf
                  <input value="{{Auth::user()->balance}}" type="hidden" id="balance">
                  <div class="row mt-3">
                    <div class="col-md-4">
                      <div class="input-item input-with-label">
                        <h5 class="mgt-1-5x font-mid">Account Bank</h5>
                        <h3><b>@isset(Auth::user()->bank){{Auth::user()->bank}} @else Not Set @endisset</b></h3>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="input-item input-with-label">
                        <h5 class="mgt-1-5x font-mid">Account Number</h5>
                        <h3><b>@isset(Auth::user()->accountno){{Auth::user()->accountno}} @else Not Set @endisset</b></h3>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="input-item input-with-label">
                        <h5 class="mgt-1-5x font-mid">Account Name</h5>
                        <h3><b>@isset(Auth::user()->accountname){{Auth::user()->accountname}} @else Not Set @endisset</b></h3>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <!-- <div class="col-6">
                      <h5 class="mgt-1-5x font-mid">Amount IN USD ($):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input type="number" name="usd" id="usd" class="copy-address" onkeyup="myFunction()" value="{{ old('usd') }}" placeholder="$20">
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                      <span class="text-danger font-italic mgb-2x"><small id="bal_error"></small></span>
                    </div> -->
                    <div class="col-12">
                      <h5 class="mgt-1-5x font-mid">Amount IN {{$basic->currency}} ({{$basic->currency_sym}}):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input value="{{$basic->rate}}" type="hidden" id="rate">
                        <input type="number" name="amount" id="naira" class="copy-address" value="{{ old('amount') }}" placeholder="{{$basic->currency_sym}}0.00">
                        <!-- <input type="hidden" name="amount" id="naira_amount" value="{{ old('amount') }}" readonly> -->
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                      @if ($errors->has('amount'))
                      <span class="error">
                        {{ $errors->first('amount') }}
                      </span><br>
                      @endif
                    </div>
                  </div>

                  <div class="pdb-2-5x pdt-1-5x mt-3">
                    <input type="checkbox" name="confirm" class="input-checkbox input-checkbox-md" id="agree-term-4" @if (old('confirm')=='on' ) checked @endif>
                    <label for="agree-term-4">I hereby confirm that the account details provided is valid</label>
                    <div class="p">
                      @if ($errors->has('confirm'))
                      <span class="error">
                        {{ $errors->first('confirm') }}
                      </span><br>
                      @endif
                    </div>

                    <div class="pdb-2-5x pdt-1-5x">
                      <input type="checkbox" name="confirm_fee" class="input-checkbox input-checkbox-md" id="agree-term-5" @if (old('confirm_fee')=='on' ) checked @endif>
                      <label for="agree-term-5">I hereby confirm Transaction fee</label>
                      <div class="p">
                        @if ($errors->has('confirm_fee'))
                        <span class="error">
                          {{ $errors->first('confirm_fee') }}
                        </span><br>
                        @endif
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
                      @if(Auth::user()->bank == "Not Set" || Auth::user()->accountno == "Not Set" || Auth::user()->accountname == "Not Set")
                      <h2>Go and update your bank account details to continue <a href="{{ route('profile') }}" class="btn btn-warning">Click Here to update</a></h2>
                      @else
                      <ul class="d-flex flex-wrap align-items-center guttar-30px">
                        <li><button type="submit" class="btn btn-primary">Confirm &amp; Withdraw</button></li>
                      </ul>
                      @endif
                      <div class="gaps-2x"></div>
                      <div class="gaps-1x d-none d-sm-block"></div>
                      <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                        <p class="text-light">You fund will appear in your account after it has been confirmed.</p>
                      </div>
                </form>
              </div>
            </div>
          </div><!-- .container -->
        </div><!-- .page-content -->
        <script>
          // window.onload = showDiv();

          function myFunction() {
            var balance = $('#balance').val();
            var rate = $('#rate').val();
            var usd = $('#usd').val();
            var amount = rate * usd;
            //console.log(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
            if (amount > 0) {
              document.getElementById("naira_amount").value = amount;
              document.getElementById("naira").value = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            if (amount > balance) {
              document.getElementById("bal_error").textContent = "* You do not have upto the requested amount in your Naira Wallte";
            } else {
              document.getElementById("bal_error").textContent = "";
            }
          };
        </script>
        @endsection