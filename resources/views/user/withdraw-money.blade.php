@extends('include.userdashboard')


@section('content')
     <!-- Main Content -->

<script type="text/javascript">
function myFunction1() {
 var amount = $('#mySelect3').val() ;
 var balance = $("#mySelect option:selected").attr('data-balance');
 var avail = $("#mySelect option:selected").attr('data-avail');
 var wallet = $("#mySelect option:selected").attr('data-wallet');
 var cur = $("#mySelect option:selected").attr('data-cur');
 var price = $("#mySelect option:selected").attr('data-rate');
 var amt =  avail / price;

  document.getElementById("balance2").innerHTML =  balance;
  document.getElementById("wallet").innerHTML =  wallet;
  document.getElementById("cur").innerHTML =  cur;
  document.getElementById("amt").innerHTML =  amt + "{{$basic->currency}}";
 };
</script>
<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><div class="step-number">01</div><div class="step-head-text"><h4>Payment Wallet</h4><p>Please fill the form below to process your withdrawal</p></div><div class="gaps-1x"></div><ul class="nav nav-tabs nav-tabs-line"  role="tablist"><li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-item-4">Crypto Wallet</a></li><li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-item-5">Deposit Wallet</a></li></ul><div class="tab-content"><div class="tab-pane fade active show" id="tab-item-4"><h4>Please fill the form below to withdraw from your cryptocurrency wallets</h4><p>

<div class="input-item input-with-label"><label for="swalllet" class="input-item-label">Select Withdrawal Wallet </label>

<select class="select-bordered select-block" required name="wallet" id="mySelect" onchange="myFunction1()">
 <option selected>Choose...</option>
 @foreach($wallet as $wallet)
<option  data-avail="{{ $wallet->balance}}" data-wallet="{{ $wallet->id}}" data-balance="{{ $wallet->balance}} {{\App\Currency::whereId($wallet->coin_id)->first()->symbol}}" data-cur="{{\App\Currency::whereId($wallet->coin_id)->first()->symbol}}" value="{{$wallet->id}}" data-rate="{{\App\Currency::whereId($wallet->coin_id)->first()->price}}"> {{$wallet->name}}  </option>
@endforeach
</select></div>
<div class="gaps-1x"></div>

<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#crypto" >Proceed</a>

</p></div>

<div class="tab-pane fade" id="tab-item-5"><h4>Please fill the form below to withdrawal from your deposit wallet</h4><p>
<form method="post" action="{{route('withdraw.depo') }}">
@csrf
<div class="input-item input-with-label"><label for="swalllet" class="input-item-label">Select Withdrawal Wallet </label>

<select class="select-bordered select-block" required name="wallet" >
 <option selected>Choose...</option>
 <option value="1">Deposit Wallet</option>
</select></div>
<p id="balance"></p>

<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Select Withdrawal Method:</label>
 <select  required  class="select-bordered select-block"  name="method_id">
 <option selected>Choose...</option>
                          @foreach($withdrawMethod as $gate)
                          <option  value="{{$gate->id}}">{{$gate->name}}</option>
                          @endforeach
                        </select>
</div>
<div class="gaps-1x"></div>
<h6 class="font-bold">Enter amount to withdraw</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span><input  required  type="number" name="amount" placeholder="{{$basic->currency_sym}} 0.00" class="copy-address" ><button class="copy-trigger copy-clipbhoard">{{$basic->currency}}</button></div>

<button tyle="submit" class="btn btn-primary">Proceed</button>

</form>
</p></div></div></div></div><!-- .card --></div><!-- .container -->



<!-- Modal start -->
<form method="post" action="{{route('withdraw.crypto') }}">
@csrf
<div class="modal fade" id="crypto" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body"><div class="step-number">02</div><h4 class="popup-title">Enter Amount To Withdraw</h4><p>You currently have <strong id="balance2">0.00</strong> in your wallet valued at <strong id="amt">0.00</strong> Withdrawal  will be processed once you click on submit.</p>
<h6 class="font-bold">Enter amount to withdraw</h6><div class="copy-wrap mgb-0-5x"><input  required  type="textr" name="amount" placeholder=" 0.00" id="mySelect3" onkeyup="myFunction1()" class="copy-address" ><button class="copy-trigger copy-clipbhoard"><a id="cur">0.00</a></button></div>
<input name="method_id" hidden value="1">
<textarea id="wallet" name="wallet" hidden></textarea>
<!-- .copy-wrap --><!-- .pay-info-list --><div class="pdb-2-5x pdt-1-5x"><input  required  type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong>withdrawal aggrement &amp; term</strong>.</label></div><button type="submit" class="btn btn-primary">Process Withdrawal  <em class="ti ti-arrow-right mgl-4-5x"></em></button><div class="gaps-3x"></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>Please note that {{$basic->sitename}} will not be held responsible for any loss arising from providing a wrong withdrawal details.</p></div></div></div><!-- .modal-content --></div><!-- Modal End -->
</form>



</div><!-- .page-content -->



@stop
