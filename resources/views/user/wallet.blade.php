@extends('include.userdashboard')
@section('content')
   <div class="page-content"><div class="container">

   <div class="d-lg-nonxe"><button href="#" data-toggle="modal" data-target="#add-wallet" class="schedule-bonus">Click Button To Update Wallet Address</button><div class="gaps-1x mgb-0-5x d-lg-none d-none d-sm-block"></div></div>
<br>
<div class="row">


 @foreach($wallet as $k=>$data)
<div class="col-lg-4"><div class="token-statistics bg-secondary card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="pay-icon cf cf-{{\App\Currency::whereId($data->coin_id)->first()->icon}}"></em></div><div class="token-balance-text"><h6 class="card-sub-title">{{\App\Currency::whereId($data->coin_id)->first()->name}} Wallet</h6><span class="lead">{{number_format($data->balance, 5)}} <span>{{\App\Currency::whereId($data->coin_id)->first()->symbol}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title"><marquee> Address: {{$data->address}}</marquee></h6><ul class="token-balance-list"><li class="token-balance-sub"><span class="lead">1</span><span class="sub">{{\App\Currency::whereId($data->coin_id)->first()->symbol}}</span></li><li class="token-balance-sub"><span class="lead">=</span></li><li class="token-balance-sub"><span class="lead">{{\App\Currency::whereId($data->coin_id)->first()->price}}</span><span class="sub">{{$basic->currency}}</span></li></ul></div></div></div></div>
@endforeach



   </div></div><!-- .row --></div><!-- .container --></div><!-- .page-content -->

<script type="text/javascript">
function myFunction1() {
 var address = $("#mySelect option:selected").attr('data-address');

     document.getElementById("address2").innerHTML = "<input name='address' class='input-bordered' value=" + address + " >";
 };
</script>


   <div class="modal fade" id="add-wallet" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body"><h4 class="popup-title">Update Wallet Address</h4><p>In order to withdraw <a href="#"><strong>Cryptocurrencies</strong></a>, please select your wallet address and enter a valid address in the input box. <strong>You will not be able to withdraw or receive coin until wallet address is setup.</strong></p>

<form method="post" action="{{route('update.wallet') }}">
@csrf
<div class="row"><div class="col-md-12"><div class="input-item input-with-label"><label for="swalllet" class="input-item-label">Select Wallet </label>

<select class="select-bordered select-block" required name="wallet" id="mySelect" onchange="myFunction1()">
 <option selected>Choose...</option>
 @foreach($wallet as $wallet)
<option value="{{$wallet->id}}" data-address="{{$wallet->address}}"> {{$wallet->name}}  </option>
@endforeach
</select>


</div><!-- .input-item --></div><!-- .col --></div><!-- .row --><div class="input-item input-with-label"><label for="token-address" class="input-item-label">Enter Wallet Address:</label>
<p id="address2"><input class="input-bordered" disabled></p>

<span class="input-note">Note: Address should be Blockchain-compliant.</span></div><!-- .input-item --><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss of coin arising from providing a wrong wallet address</p></div><div class="gaps-3x"></div><div class="d-sm-flex justify-content-between align-items-center"><button class="btn btn-primary">Update Wallet Address</button><div class="gaps-2x d-sm-none"></div></div></form><!-- form --></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->

@stop
