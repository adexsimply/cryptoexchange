@extends('include.userdashboard')
@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="card-head">
              <h4 class="card-title">Buy Cryptocurrency</h4>
            </div>
            <div class="card-text">
              <p>Please select any of the following e-currency to continue your purchase.</p>
            </div>
            <div class="token-currency-choose">
              <div class="row guttar-15px">
                @foreach($currency as $data)
                <!-- {{$data}} -->
                <div class="col-6 a1" data-coin="{{$data->id}}" data-sym="{{$data->symbol}}" data-id="{{$data->name}}" data-rate="{{$data->buy}}">
                  <div class="pay-option">
                    <input class="pay-option-check" type="radio" data-id="{{$data->id}}" name="currency_id">
                    <label class="pay-option-label" for="{{$data->id}}"><span class="pay-title">
                        <em class="pay-icon cf cf-@if($data->icon =='paypal')pivx @else{{$data->icon}}@endif"></em>
                        <span class="pay-cur">{{$data->symbol}}</span></span>
                      <span class="pay-amount">{{$basic->currency_sym}}{{number_format($data->buy, $basic->decimal)}} / $1</span>
                    </label>
                  </div>
                </div>
                @endforeach
                <script>
                  function myFunction() {
                    var usd = $('#usd').val();
                    var local = $('#local').val();
                    var value2 = $("#mySelect option:selected").attr('data-value2');
                    var price = $("#mySelect option:selected").attr('data-price');
                    var coin = $("#mySelect option:selected").attr('data-coin');
                    var name = $("#mySelect option:selected").attr('data-name');
                    var sell = $("#mySelect option:selected").attr('data-sell');
                    var cur = $("#mySelect option:selected").attr('data-cur');
                    // document.getElementById("cur").innerHTML = cur;

                    if (cur == 0) {
                      document.getElementById("show").innerHTML = "<div class='note note-plane note-danger'><em class='fas fa-info-circle'></em><p>Please select a crypto currency to proceed with purchase</p></div>";
                    } else {
                      document.getElementById("show").innerHTML = "<a href='{{ route('confirm_buy_first',"") }}/" + value2 + "' class='btn btn-outline btn-secondary btn-md'>Proceed &nbsp; <em class='ti ti-shopping-cart'></em></a>";
                    }
                    console.log(value2)

                  };
                </script>
              </div><!-- .row -->
            </div>
            <div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Select E-Currency</label>
              <div class="relative"><span class="input-icon input-icon-right">{{$basic->currency}}</span>
                <select required class="select-bordered select-block" id="mySelect" onchange="myFunction()" name="method_id">
                  <option data-cur="0" selected>Choose...</option>
                  @foreach($currency as $data)
                  <option data-coin="{{$data->symbol}}" data-cur="{{$data->id}}" data-sell="{{$data->sell}}" data-name="{{$data->name}}" data-address="{{App\Cryptowallet::whereCoin_id($data->id)->first()->address}}" data-price="{{$data->price}}" data-value2="{{$data->id}}" value="{{$data->id}}">{{$data->name}} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <a id="show"></a>

            <div class="card-head"><span class="card-sub-title text-primary font-mid"><br><br>Please Note Your transaction will be calculated at the current market price of the intended coin</span></div>
            <!-- .container -->
          </div><!-- .container -->
        </div><!-- .page-content -->
        @endsection