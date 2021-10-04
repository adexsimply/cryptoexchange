@extends('include.userdashboard')

@section('content')



<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="card-head">
              <h4 class="card-title">Sell Cryptocurrency</h4>
            </div>
            <div class="card-text">
              <p>Please select any of the following e-currencies to continue your sale.</p>
            </div>
            <div class="token-currency-choose">
              <div class="row guttar-15px">
                @foreach($currency as $data)
                <div class="col-6 a1" data-coin="{{$data->id}}" data-sym="{{$data->symbol}}" data-id="{{$data->name}}" data-rate="{{$data->buy}}">
                  <div class="pay-option"><input class="pay-option-check" type="radio" data-id="{{$data->id}}" name="currency_id">
                    <label class="pay-option-label" for="{{$data->id}}"><span class="pay-title"><em class="pay-icon cf cf-@if($data->icon =='paypal')pivx @else{{$data->icon}}@endif"></em><span class="pay-cur">{{$data->symbol}}</span></span><span class="pay-amount">{{$basic->currency_sym}}{{number_format($data->buy, $basic->decimal)}}</span></label>
                  </div>
                </div>
                @endforeach
                <script>
                  function myFunction() {
                    var usd = $('#usd').val();
                    var local = $('#local').val();
                    var price = $("#mySelect option:selected").attr('data-price');
                    var coin = $("#mySelect option:selected").attr('data-coin');
                    var name = $("#mySelect option:selected").attr('data-name');
                    var buy = $("#mySelect option:selected").attr('data-buy');
                    var cur = $("#mySelect option:selected").attr('data-cur');
                    var rate = usd * buy;
                    document.getElementById("local").value = "{{$basic->currency_sym}}" + rate;
                    document.getElementById("buy").innerHTML = buy;
                    document.getElementById("name").innerHTML = name;
                    document.getElementById("cur").innerHTML = cur;

                    if (cur == 0) {
                      document.getElementById("show").innerHTML = "<div class='note note-plane note-danger'><em class='fas fa-info-circle'></em><p>Please select a crypto currency to proceed with sale</p></div>";
                    } else {
                      document.getElementById("show").innerHTML = "<a href='#' data-toggle='modal' data-target='#pay-confirm' class='btn btn-secondary btn-md  btn-outline'>Proceed &nbsp;<em class='ti ti-wallet'></em></a>";
                    }

                    var bank = $("#mybank option:selected").attr('data-bank');
                    var bankname = $("#mybank option:selected").attr('data-bankname');

                    if (bank == 0) {
                      document.getElementById("bank").innerHTML = " ";
                    }
                    if (bank == 1) {
                      document.getElementById("bank").innerHTML = "<div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your " + bankname + " Account Number</label><input name='actnumber'  required  class='input-bordered' type='text'></div> ";
                    }
                    if (bank == 2) {
                      document.getElementById("bank").innerHTML = " <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Bank Name</label><input required name='bankname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='acctname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='actnumber'  required  class='input-bordered' type='text'></div>";
                    }

                  };
                </script>
              </div><!-- .row -->
            </div>
            <div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Select E-Currency</label>
              <div class="relative"><span class="input-icon input-icon-right">{{$basic->currency}}</span>
                <select required class="select-bordered select-block" id="mySelect" onchange="myFunction()" name="method_id">
                  <option data-cur="0" selected>Choose...</option>
                  @foreach($currency as $data)
                  <option data-coin="{{$data->symbol}}" data-cur="{{$data->id}}" data-buy="{{$data->buy}}" data-name="{{$data->name}}" data-address="{{App\Cryptowallet::whereCoin_id($data->id)->first()->address}}" data-price="{{$data->price}}" value="{{$data->id}}">{{$data->name}} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <a id="show"></a>
            <br>
            <div class="card-head"><span class="card-sub-title text-primary font-mid">Please Note Your transaction will be calculated at the current market price of the intended coin</span></div>
            <!-- .container -->
          </div><!-- .container -->
        </div><!-- .page-content -->


        <!-- Modal End -->


        <div class="modal fade" id="pay-confirm" tabindex="-1">
          <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
              <div class="popup-body">
                <h4 class="popup-title">Sell <a id="name"> <a /></h4>
                <p class="lead text-primary">1USD = {{$basic->currency_sym}}<a id="buy"></a> </p>
                <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                  <p>The sold <a id="name"></a> will be approved after your transaction has been confirmed and approved on our server..</p>
                </div>
                <div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
                  <p>Ensure you enter a <strong>valid account details</strong> {{$basic->sitename}} will not be liable for any loss arising from your entering a wrong wrong account details.</p>
                </div>
                <br>
                <form method="POST" action="{{ route('sellecoin') }}">
                  @csrf
                  <div class="row">
                    <textarea row="1" name="coin" required hidden class="input-bordered" type="text" id="cur"></textarea>
                    <div class="col-md-6">
                      <div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount In USD</label><input id="usd" onkeyup="myFunction()" name="usd" placeholder="$0.00" class="input-bordered" type="text"></div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount In {{$basic->currency}}</label>
                        <input placeholder="{{$basic->currency_sym}}0.00" id="local" onkeyup="myFunction()" class="input-bordered" name="local" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-item input-with-label"><label class="input-item-label text-exlight">Select Bank</label>

                        <select required class="select-bordered select-block" name="bank" id="mybank" onchange="myFunction()">
                          <option selected>Choose...</option>
                          @foreach($localbanks as $data)
                          <option data-bank="1" data-bankname="{{$data->bank}}" value="{{$data->code}}">{{$data->bank}} </option>
                          @endforeach
                          <option data-bank="2" value="other"><b>Other Banks</b></option>
                        </select>
                      </div>
                    </div>
                  </div>





                  <div id="bank"></div>


                  <!-- .input-item -->
                  <ul class="d-flex flex-wrap align-items-center guttar-30px">
                    <li><button type="submit" class="btn btn-primary  btn-outline">Sell</button></li>
                </form>
                </ul>
                <div class="gaps-2x"></div>
                <div class="gaps-1x d-none d-sm-block"></div>
              </div>
            </div><!-- .modal-content -->
          </div><!-- .modal-dialog -->
        </div><!-- Modal End -->


        @endsection