@extends('include.userdashboard')
@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="">
              <div class="popup-body">
                <h3 class="popup-title" style="font-size: 30px;">Sell <a id="name">{{$currency->name}}</a><a></a></h3>
                <!-- <p class="lead text-primary"><a>1USD = {{$basic->currency_sym}}{{$currency->buy}}</p> -->
                <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                  <p>Note: Find below the summary of your Bitcoin purchase. {{$basic->sitename}} will not be liable to any loss arising from wrong wallet address, or reduction in Bitcoin price rate</p>
                </div>
                <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                  <p>Note: The purchased will appear in your <a id="currency2">{{$currency->name}}</a> Wallet only after you transaction has been confirmed and approved on our server.</p>
                </div>
                <!-- <div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
                  <p>Ensure you enter a <strong>valid <b>{{$currency->name}}</b> wallet address</strong> not be liable for any loss arising from you entering a wrong <b>{{$currency->name}}</b> wallet address.</p>
                </div> -->
                <br>
                <form method="POST" action="{{ route('confirm_sell') }}">
                  @csrf
                  <input value="{{$currency->id}}" type="hidden" name="coin">
                  <input value="{{Auth::user()->balance}}" type="hidden" id="balance">
                  <input value="{{$currency->sell}}" type="hidden" name="coin_rate">
                  <div id="summary">
                    <div class="card-head">
                      <h5 class="card-title card-title-md">Currency Summary</h5>
                    </div>
                    <div class="schedule-item">
                      <div class="row">
                        <div class="col-xl-4 col-md-5 col-lg-4">
                          <div class="pdb-1x">
                            <h5 class="schedule-title"><span>Naira Wallet Balance</span> </h5><span><b style="color: #21a184;">{{$basic->currency_sym}}{{ number_format(Auth::user()->balance, $basic->decimal) }}</b></span>
                          </div>
                        </div>
                        <div class="col-xl-4 col-md-5 col-lg-4">
                          <div class="pdb-1x">
                            <h5 class="schedule-title"><span>{{$currency->symbol}} Sell Rate</span> </h5><span><b style="color: #21a184;">1USD = {{$basic->currency_sym}}{{ number_format($currency->sell, $basic->decimal) }}</b></span>
                          </div>
                        </div>
                        <div class="col-xl-4 col-md col-lg-4">
                          <div class="pdb-1x">
                            <h5 class="schedule-title"><span>Amount In {{$basic->currency}}</span></h5>
                            <span"><b id="amount_ng" style="color: #21a184;">{{$basic->currency_sym}}{{ number_format(0, $basic->decimal) }}</b></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-6">
                      <h5 class="mgt-1-5x font-mid">Amount IN USD ($):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input type="number" name="usd" id="usd" class="copy-address" onkeyup="myFunction()" value="{{ old('usd') }}" placeholder="$5">
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                      <span class="text-danger mgb-2x"><small id="amount_error"></small></span>
                    </div>
                    <div class="col-lg-6">
                      <h5 class="mgt-1-5x font-mid">Amount IN {{$basic->currency}} ({{$basic->currency_sym}}):</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input value="{{$currency->sell}}" type="hidden" id="rate">
                        <input required="" type="" name="yoo_amount" id="naira" class="copy-address" value="{{ old('yoo_amount') }}" placeholder="{{$basic->currency_sym}}0.00" readonly>
                        <input type="hidden" name="amount" id="naira_amount" value="{{ old('amount') }}" readonly>
                        <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
                      </div>
                      <span class="text-light mgb-2x"><small>
                          @if ($errors->has('amount'))
                          <span class="error" style="color: red;">
                            {{ $errors->first('amount') }}
                          </span><br>
                          @endif
                        </small>
                      </span>
                    </div>
                  </div>
                  <!-- <div class="row mb-3">
                    <div class="col-md-6">
                      <h5 class="mgt-1-5x font-mid">{{$currency->name}} Wallet Address / Account ID</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input placeholder="" name="wallet" value="{{ old('wallet') }}" class="input-bordered" type="text">
                        @if ($errors->has('wallet'))
                        <span class="error">
                          {{ $errors->first('wallet') }}
                        </span><br>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h5 class="mgt-1-5x font-mid">Retype {{$currency->name}} Wallet Address / Account ID</h5>
                      <div class="copy-wrap mgb-0-5x">
                        <input name="rewallet" placeholder="" value="{{ old('rewallet') }}" class="input-bordered" type="text">
                        @if ($errors->has('rewallet'))
                        <span class="error">
                          {{ $errors->first('rewallet') }}
                        </span><br>
                        @endif
                      </div>
                    </div>
                  </div> -->

                  <div class="text-left mt-2" id="buy_btn" style="display: none;">
                    <button type="submit" onclick="return confirm('Are you sure you want to Proceed?')" class="btn btn-primary btn-outline">Proceed To Sell</button></li>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-head"><span class="card-sub-title text-primary font-mid"><br><br>Please Note Your transaction will be calculated at the current market price of the intended coin</span></div>
            <!-- .container -->
          </div><!-- .container -->
        </div><!-- .page-content -->
      </div>
    </div>
  </div>
</div>



<script>
  // function showDiv() {
  //     var strUser = numberToSelect.value;
  //     console.log(strUser)
  // }
  function myFunction() {
    var div = document.getElementById("buy_btn");
    var rate = $('#rate').val();
    var usd = $('#usd').val();
    var balance = $('#balance').val();
    var amount = rate * usd;
    //console.log(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
    if (amount > 0) {
      document.getElementById("naira_amount").value = amount;
      document.getElementById("amount_ng").textContent = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      document.getElementById("naira").value = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    if (amount == "") {
      amount = 0;
      document.getElementById("naira_amount").value = amount;
      document.getElementById("amount_ng").textContent = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      document.getElementById("naira").value = "{{$basic->currency_sym}}" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    // console.log(balance)
    checkAmount()
  };

  function checkAmount() {
    var div = document.getElementById("buy_btn");
    var rate = $('#rate').val();
    var usd = $('#usd').val();
    var balance = $('#balance').val();
    var amount = rate * usd;
    // console.log(rate)
    // console.log(usd)
    // console.log(amount)
    if (amount < 500) {
      div.style.display = 'none';
      document.getElementById("amount_error").textContent = "The Mininmum Amount is ₦500";
    }
    if (amount >= 500) {
      div.style.display = 'block';
      document.getElementById("amount_error").textContent = "";
    }
    // if (amount > balance) {
    //   div.style.display = 'none';
    //   document.getElementById("amount_error").textContent = "* Not enough balance in your Naira Wallet, fund it and try again";
    // } else {
    //   div.style.display = 'block';
    //   document.getElementById("amount_error").textContent = "";
    // }
  }

  window.onload = checkAmount();
</script>
@endsection