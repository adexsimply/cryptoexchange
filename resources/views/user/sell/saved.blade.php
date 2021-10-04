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
          <div class="card-innr">
            <h4 class="card-title" id="dep_text">Sell Transaction Preview</h4>
            <div class="text-right mt-2">
              <a href="{{ route('cancel_sell',$data->trx) }}" onclick="return confirm('Are you sure you want to Cancelled this Deposit Transaction?')" class="btn btn-danger btn-between">Cancel Payment <em class="ti ti-wallet"></em></a>
            </div>

            <div id="confirm">
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 1</span>
                <h4 class="card-title"> Payment Preview</h4>
              </div>
              <div class="card-text">
                <p>You have opted to Sell using
                  <!-- <b style="color:#21a184">{{$data->payment_method_id}}</b> -->
                  Please find your pre-payment summary below.
                </p>
              </div>

              <div class="token-overview-wrap">
                <div class="token-overview">
                  <div class="row">
                    <div class="col-md-3 col-sm-6">
                      <div class="token-bonus token-bonus-sale"><span class="token-overview-title">Coin</span>
                        <span class="token-overview-value bonus-on-sale">{{ $data->currency->name}} ({{$data->currency->symbol}})</span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="token-bonus token-bonus-amount"><span class="token-overview-title">{{$data->currency->symbol}} Sell Rate</span><span class="token-overview-value bonus-on-amount">{{ $basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}/$</span></div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="token-bonus token-bonus-amount"><span class="token-overview-title">Amount IN USD</span><span class="token-overview-value bonus-on-amount">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="token-total"><span class="token-overview-title font-bold">Amount IN {{ $basic->currency}}</span><span class="token-overview-value token-total-amount text-primary">{{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div>
                    </div>

                  </div>
                </div>
                <br>
                <div class="note note-plane note-danger mgb-1x"><em class="fas fa-info-circle"></em>
                  <p>Note: Do not send below the Total Amount of ${{number_format($data->currency_amount_usd, $basic->decimal)}} worth of {{$data->currency->symbol}}</p>
                </div>
                <div class="note note-plane note-danger mgb-1x"><em class="fas fa-info-circle"></em>
                  <p>Note: {{$basic->sitename}} will not be responsible for funding a wrong account number provided by you</p>
                </div>
              </div>
              <hr>
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 2</span>
                <h4 class="card-title">Send Coin Using Details Below </h4>
              </div>
              <div class="card-text">
                <p>Please pay ${{number_format($data->currency_amount_usd, $basic->decimal)}} worth of {{$data->currency->symbol}} to the wallet address below or scan the wallet QR Code above to initiate payment form your wallet app.</p>
              </div>
              <div class="schedule-item">
                <center>
                  <img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$data->currency->payment_id}}&choe=UTF-8\" style=' width:100px;' />
                  <h2 style="font-weight:600">{{$data->currency->payment_id}}</h2>
                </center>
                <div class="referral-form">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-bold">Wallet Address</h5><a href="#" class="link link-primary link-ucap">Copy</a>
                  </div>
                  <div class="copy-wrap mgb-1-5x mgt-1-5x">
                    <span class="copy-feedback"></span>
                    <input type="text" class="copy-address" value="{{$data->currency->payment_id}}" disabled>
                    <button class="copy-trigger copy-clipboard" data-clipboard-text="{{$data->currency->payment_id}}">
                      <em class="ti ti-files"></em></button>
                  </div>

                </div>
              </div>
              <div class="gaps-3x"></div>
              <hr>
              <div class="card-head"><span class="card-sub-title text-primary font-mid">Step 3</span>
                <h4 class="card-title">Confirm Transaction</h4>
              </div>
              <div class="card-text">
                <p>Click on the button below after making a successful transaction</p>
              </div>
              <div class="text-left mt-2">
                <button type="submit" onclick="proceed()" class="btn btn-primary btn-between">Proceed To Confirm Transaction <em class="ti ti-wallet"></em></button>
              </div>
            </div>
            <div id="back_confirm" style="display:none">
              <div class="mt-3">
                <div class="">
                  <form method="POST" action="{{ route('save_sell') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                      <p>Note: If you have paid to our {{$data->currency->name}} wallet address, enter your transaction number below and a screenshot of your successful payment page</p>
                    </div>
                    <div class="col-md-12">
                      <div class="input-item input-with-label">
                        <label class="input-item-label text-exlight">Enter Your Transaction Number</label>
                        <input required name="trans_number" class="input-bordered" type="text">
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
                      <button type="submit" class="btn btn-primary btn-between mb-4">Confirm Payment</button>
                    </div>
                    <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                      <p>Note: Do not proceed with this process if you have not made your payment</p>
                    </div>
                    <div class="note note-plane note-danger mgb-1x"><em class="fas fa-info-circle"></em>
                      <p>Note: In case you sent a different amount, send us a message,{{$basic->sitename}} will update accordingly</p>
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