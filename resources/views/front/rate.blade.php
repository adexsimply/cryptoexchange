@extends('include.front')
@section('content')

<!-- .header-main @e -->
<!-- Banner @s -->
<div class="header-banner bg-theme-grad-s2">
  <div class="nk-banner">
    <div class="banner banner-page">
      <div class="banner-wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-9">
              <div class="banner-caption cpn tc-light text-center">
                <div class="cpn-head">
                  <h2 class="title ttu">Exchange Rate</h2>
                  <p>We ensure transparency on {{$basic->sitename}}. You have autonomy over your wallet and we make sure no fund is lost on trades.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- .nk-banner -->
  <div class="nk-ovm shape-a-sm"></div>
</div><!-- .header-banner @e -->
</header>
<main class="nk-pages">
  <section class="section bg-white">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-5 mgb-r">
          <h3 class="title title title-md">Supported Cryptocurrencies</h3>
          <p>Our list of supported cryptocurrencies</p>
          <table class="table">
            <tbody>

              @foreach($currency as $key => $data)
              <tr>
                <td class="table-head">{{$data->name}}</td>
                <td class="table-des">{{number_format($data->price, $basic->decimal)}} USD</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="col-lg-5">
          <h3 class="title title title-md">{{$basic->sitename}} Trade Rate</h3>
          <p>Coin Exchange Price + {{$basic->sitename}} Charge</p>
          <table class="table table-bordered">
            <tbody>
              <tr><b>
                  <td class="table-head">Coins</td>
                  <td class="table-head">We Buy At</td>
                  <td class="table-head">We Sell At</td>
                </b></tr>
              @foreach($currency as $key => $data)
              <tr>
                <td class="table-head">{{$data->name}}</td>
                <td class="table-des">{{number_format($data->sell, $basic->decimal)}} {{$basic->currency}}</td>
                <td class="table-des">{{number_format($data->buy, $basic->decimal)}} USD</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>



  <script>
    function myFunction() {
      var amount = $('#mySelect2').val();

      var price = $("#mySelect option:selected").attr('data-price');
      var name = $("#mySelect option:selected").attr('data-name');
      var sell = $("#mySelect option:selected").attr('data-sell');
      var buy = $("#mySelect option:selected").attr('data-buy');
      var cur = $("#mySelect option:selected").attr('data-cur');
      var rate = Math.round(price).toFixed(2);

      var sellcharge = amount * sell / 100;
      var buycharge = amount * buy / 100;
      var paybuy = 1 * amount - buycharge;
      var paysell = 1 * amount + sellcharge;
      var rate = parseFloat(1 * amount / price).toFixed(8);

      document.getElementById("unit").innerHTML = "What you get: " + rate + cur;

      document.getElementById("buy").innerHTML = "We buy at: USD " + paybuy;
      document.getElementById("sell").innerHTML = "We sell at: USD " + paysell;
      var unit = parseFloat(amount / price).toFixed(8);
      document.getElementById("price").innerHTML = "USD " + Math.round(rate).toFixed(2);

    };
  </script>


  <section class="section bg-light">
    <div class="container "><br>
      <h3 class="title title-md">Cryptocurrency Calculator</h3>

      <div class="field-item"><label class="field-label">Select Cryptocurrency</label>
        <div class="field-wrap">
          <select onchange="myFunction()" class="selec form-control" id="mySelect">
            <option value="">Please select</option>
            @foreach($currency as $key => $data)
            <option data-cur="{{$data->symbol}}" data-sell="{{$data->sell}}" data-name="{{$data->name}}" data-price="{{$data->price}}" data-buy="{{$data->buy}}">{{$data->name}} </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="field-item"><label class="field-label">Input Amount</label><small>
          <p>Enter amount in <code> USD </code> </p>
        </small>
        <div class="field-wrap"><input id="mySelect2" onkeyup="myFunction()" type="number" class="input-bordered" required></div>
      </div>


      <p id="buy"></p>
      <p id="sell"></p>
      <p id="unit"></p>


    </div>
  </section>


</main>
@endsection