@extends('include.userdashboard')

@section('content')

<script>

function myFunction() {
 var amount = $('#mySelect2').val() ;
 var have = $("#mySelect1 option:selected").attr('data-name');
 var getcoin = $("#mySelect option:selected").attr('data-name');
 var rate = $("#mySelect option:selected").attr('data-exchange');
 var hprice = $("#mySelect1 option:selected").attr('data-price');
 var gprice = $("#mySelect option:selected").attr('data-price');
 var gcur = $("#mySelect option:selected").attr('data-gcur');
 var hcur = $("#mySelect1 option:selected").attr('data-hcur');
 var getadd = $("#mySelect option:selected").attr('data-address');
 var gid = $("#mySelect option:selected").attr('data-gid');
 var hid = $("#mySelect1 option:selected").attr('data-hid');
 var address = $("#mySelect1 option:selected").attr('data-address');

 var dol = parseFloat((amount/"{{$basic->rate}}")*1);
var charge1 = (dol*rate)/100;
var charge = parseFloat(charge1 / gprice).toFixed(5);
var get1 = parseFloat(dol / gprice).toFixed(5);
var get = parseFloat(get1 - charge).toFixed(5);
var havec = parseFloat(dol / hprice).toFixed(5);


  if (typeof gcur === "undefined") {
    cur = " ";
  } else {
    cur = gcur;
  }


  if (typeof have === "undefined") {
    have = "<div class='note note-plane note-danger note-sm pdt-1x pl-0'><p>You must select the currency <br>you have at hand first.</p></div>";
  } else {
    have = have;
  }



 document.getElementById("have").innerHTML = have;
 document.getElementById("have3").innerHTML = have;
 document.getElementById("have4").innerHTML = have;
 document.getElementById("have5").innerHTML = have;
 document.getElementById("have6").innerHTML = have;
 document.getElementById("have7").innerHTML = have;
 document.getElementById("havec").innerHTML = havec;
 document.getElementById("havec1").innerHTML = havec + hcur;
 document.getElementById("unithave").innerHTML = havec;
 document.getElementById("unithave1").innerHTML = havec;
 document.getElementById("have2").innerHTML = havec + hcur;
 document.getElementById("get").innerHTML = get ;
 document.getElementById("unitget").innerHTML = get ;
 document.getElementById("unitget1").innerHTML = get ;

 document.getElementById("get2").innerHTML = get + gcur ;
 document.getElementById("get3").innerHTML = getcoin ;
 document.getElementById("get4").innerHTML = getcoin ;
 document.getElementById("get5").innerHTML = getcoin ;
 document.getElementById("get6").innerHTML = getcoin ;
 document.getElementById("getadd").innerHTML = getadd ;
 document.getElementById("getadd1").innerHTML = getadd ;
 document.getElementById("charge").innerHTML = charge ;
 document.getElementById("charge1").innerHTML = charge ;

 document.getElementById("address").value = address;
document.getElementById("qr").innerHTML = "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl="+address+"&choe=UTF-8\" style='width:200px;' />";
 document.getElementById("gid").innerHTML = gid ;
 document.getElementById("hid").innerHTML = hid ;
 document.getElementById("gid1").innerHTML = gid ;
 document.getElementById("hid1").innerHTML = hid ;
 document.getElementById("hamount").innerHTML = amount;
 document.getElementById("hamount1").innerHTML = amount;

 document.getElementById("gcur").innerHTML = cur;
 document.getElementById("amount").innerHTML = "{{$basic->currency_sym}}"+amount;

 };
</script>




 <div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12"><div class="content-area card"><div class="card-innr"><div class="card-head"><span class="card-sub-title text-primary font-mid">Step 1</span><h4 class="card-title">What Do You Have?</h4></div><div class="card-text"><p>Please select the cryptocurrency you have at hand.</p></div><div class="token-currency-choose">

<select required  class="select-bordered select-block" id="mySelect1" onchange="myFunction()" name="have">
<option selected>Choose...</option>
@foreach($currency as $data)
<option data-name="{{$data->name}}" data-price="{{$data->price}}"  data-hcur="{{$data->symbol}}" data-hid="{{$data->id}}"  data-exchange="{{$data->exchange}}" data-address="{{$data->payment_id}}" value="{{$data->id}}">{{$data->name}} </option>
@endforeach
</select>

</div><!-- .row -->


<div class="card-head"><span class="card-sub-title text-primary font-mid">Step 2</span><h4 class="card-title">What Do You Want?</h4></div><div class="card-text"><p>Please select the cryptocurrency you want to receive in exchange </p></div>

<div class="input-item input-with-label"><label class="input-item-label ucap text-exlight"></label><div class="relative"><span class="input-icon input-icon-right">{{$basic->currency}}</span>
<select required  class="select-bordered select-block" id="mySelect" onchange="myFunction()" name="want">
<option selected>Choose...</option>
@foreach($currency2 as $data)
<option  data-name="{{$data->name}}"  data-gcur="{{$data->symbol}}"  data-price="{{$data->price}}" data-address="{{App\Cryptowallet::whereCoin_id($data->id)->first()->address}}"    data-exchange="{{$data->exchange}}" data-gid="{{$data->id}}">{{$data->name}} </option>
@endforeach
</select></div></div>




<div class="card-head"><span class="card-sub-title text-primary font-mid">Step 3</span><h4 class="card-title">Amount To Exchange</h4></div><div class="card-text"><p>Enter the amount, you would like to exchange in {{$basic->currency}} to get the unit equivalent of the coin you will get. </p></div>

<div class="input-item input-with-label"><label class="input-item-label ucap text-exlight"></label><div class="relative"><span class="input-icon input-icon-right">{{$basic->currency}}</span><input id="mySelect2" onkeyup="myFunction()" placeholder="Enter Amount" class="input-bordered" type="number"></div></div>



<div class="token-overview-wrap"><div class="token-overview"><div class="row"><div class="col-md-4 col-sm-6"><div class="token-bonus token-bonus-sale"><span class="token-overview-title" id="coin">What You Have</span><span class="token-overview-value bonus-on-sale">


<a id="havec"></a>
<a id="have">0.00</a>

</span></div></div><div class="col-md-4 col-sm-6"><div class="token-bonus token-bonus-amount"><span class="token-overview-title">Amount To Exchange</span><span class="token-overview-value bonus-on-amount">

<a id="amount">{{$basic->currency_sym}}0.00</a>

</span></div></div><div class="col-md-4"><div class="token-total"><span class="token-overview-title font-bold">What You Get</span>

<span class="token-overview-value token-total-amount text-primary" id="gcur"></span>
<span class="token-overview-value token-total-amount text-primary" id="get">0.00</span>


</div></div></div></div><div class="note note-plane note-danger note-sm pdt-1x pl-0"><p>Your coin exchange will be calculated based on exchange rate at the moment your transaction is confirm.</p></div></div><div class="card-head"><span class="card-sub-title text-primary font-mid">Step 3</span><h4 class="card-title">Exchange Coin</h4></div><div class="card-text"><p>Click the button below to activate exchange button. You can exchange directly from your coin wallet or you send directly to our wallet address.  </p></div>

<br>
<button href="#" class="btn btn-light-alt">Activate/Deactivate Exchange Button</button>

<divv class="pay-buttons" id="myDIV"><div class="pay-button"><a href="#" data-toggle="modal" data-target="#get-pay-address" class="btn btn-secondary btn-between w-100">Exchange From Wallet <em class="ti ti-wallet"></em></a></div><div class="pay-button-sap">or</div><div class="pay-button"><a href="#" data-toggle="modal" data-target="#pay-online" class="btn btn-primary btn-between w-100">Scan QR Code<em class="ti ti-credit-card"></em></a></div></divv>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#hide").ready(function(){
    $("divv").hide();
  });

});
</script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $("divv").toggle();
  });
});
</script>



<div class="pay-notes"><div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em><p>Exchange will be effected after transaction has been successfully received and approved by our server. <br class="d-none d-lg-block"> </p></div></div></div> <!-- .card-innr --></div> <!-- .content-area --></div><!-- .col --> <!-- .container --></div><!-- .container --></div><!-- .page-content -->




<!-- Modal End --><div class="modal fade" id="get-pay-address" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body"><h4 class="popup-title">Payment Via Wallet</h4><p>You are about to exchange <strong id="have2">0.00</strong> from your <a id="have3">crypto</a> wallet. <strong id="get2">0.00</strong> will be credited to your  <a id="get3">crypto</a> wallet once exchange is successful.</p>


<!-- .pay-info-list --><button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#pay-confirm">Exchange <a id="have5">Coin</a>  <em class="ti ti-arrow-right mgl-4-5x"></em></button><div class="gaps-3x"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>Ensure you have updated your <a id="get4">crypto</a> wallet before proceeding to exchange it for <a id="have4"></a>.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss of fund arising from supplying a wrong wallet address.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->


<form id="redirectForm" class="part-form" action="{{route('exchange.wallet')}}" method="post">
@csrf
<div class="modal fade" id="pay-confirm" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Confirm Your Exchange</h4><p>To <strong>ensure safety of your coin, </strong> please confirm the <a id="get6"></a> wallet belongs to you and it is correct.</p>
<label for="token-address" class="input-item-label">Select Preferred Payment</label>
<div class="row guttar-vr-5px"><div class="col-sm-6 col-lg-6"><div class="input-item"><input type="radio" value="0" class="input-radio input-radio-md" name="radio2" id="radio_1"><label for="radio_1">My {{$basic->sitename}} Wallet</label></div></div>

<div class="col-sm-6 col-lg-6"><div class="input-item"><input type="radio" class="input-radio input-radio-md" value="1" name="radio2" id="radio_2"><label for="radio_2">External Wallet</label></div></div> </div>

<textarea row="1" name="hhave" required   hidden class="input-bordered" type="text" id="unithave"></textarea>
<textarea row="1" name="gget"  required  hidden  class="input-bordered" type="text" id="unitget"></textarea>
<textarea row="1" name="charge"  required  hidden class="input-bordered" type="text" id="charge"></textarea>
<textarea row="1" name="hcoin"  required  hidden class="input-bordered" type="text" id="hid"></textarea>
<textarea row="1" name="gcoin"  required  hidden class="input-bordered" type="text" id="gid"></textarea>
<textarea row="1" name="hamount"  required  hidden class="input-bordered" type="text" id="hamount"></textarea>

<div class="pdb-2-5x pdt-1-5x"><input required type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong> sales aggrement &amp; terms</strong>.</label></div>

<!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Confirm Exchange</button></li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pay-online" class="link link-primary">3 Party Exchange</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>

<p class="lead text-primary"><strong>Your <a id="get5"></a> Address:</strong> <a id="getadd"></a></p>

<p>To change your payment account or to receive into another Account, <a href="{{route('wallet')}}">Click Here</a>.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong payment account.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
</form>




<form method="POST" action="{{route('exchange.online')}}" enctype="multipart/form-data">
@csrf
<div class="modal fade" id="pay-online" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Confirm Your Exchange</h4><p class="lead text-primary">Your <a id="have6"></a> exchange of <strong id="havec1">0.00</strong> has been placed. </p><p>Please scan the<strong> QR Code</strong> to send <a id="have7"></a> to our wallet. Your exchange will be processed upon receiving your coin</p>




<center>
<h5 class="mgt-1-5x font-mid">Scan QR Code:</h5>

<a id="qr"></a>


<h6 class="font-bold">Or Send To Our <a id="name90"></a>  Wallet Address</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span><input type="text" class="copy-address" id="address" value="0" disabled=""><buttonn onclick="myFunction2()" class="copy-trigger copy-clipboard"><em class="ti ti-files"></em></buttonn></div>

<script>
function myFunction2() {
  var copyText = document.getElementById("address");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
 (function () {
		  $(function () {
		   return $.growl.notice({
				message: "Copied wallet address: " + copyText.value
			});
  		  });
		}).call(this);
}
</script>


<span class="text-light font-italic mgb-2x"><small>* blockchain may charge you a transaction processing fees.</small></span>
</center>
<hr>





 <div class="input-item "><label class="input-item-label">Enter Transaction Ref. Number</label><div class="relative"><em class="input-file-icon fas fa-credit-card"></em><input type="text" name="account" class="input-bordered"> </div></div>

 <div class="input-item input-with-label"><label class="input-item-label">File Upload</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" name="image" id="file-01"><label for="file-01">Choose a file</label></div></div>

<label for="token-address" class="input-item-label">Select Preferred Payment</label>
<div class="row guttar-vr-5px"><div class="col-sm-6 col-lg-6"><div class="input-item"><input type="radio" value="0" class="input-radio input-radio-md" name="radio2" id="radio_11"><label for="radio_11">My {{$basic->sitename}} Wallet</label></div></div>

<div class="col-sm-6 col-lg-6"><div class="input-item"><input type="radio" class="input-radio input-radio-md" value="1" name="radio2" id="radio_21"><label for="radio_21">External Wallet</label></div></div> </div>


<textarea row="1" name="hhave" required   hidden class="input-bordered" type="text" id="unithave1"></textarea>
<textarea row="1" name="gget"  required  hidden  class="input-bordered" type="text" id="unitget1"></textarea>
<textarea row="1" name="charge"  required  hidden class="input-bordered" type="text" id="charge1"></textarea>
<textarea row="1" name="hcoin"  required  hidden class="input-bordered" type="text" id="hid1"></textarea>
<textarea row="1" name="gcoin"  required  hidden class="input-bordered" type="text" id="gid1"></textarea>
<textarea row="1" name="hamount"  required  hidden class="input-bordered" type="text" id="hamount1"></textarea>

<div class="pdb-2-5x pdt-1-5x"><input required checked type="checkbox" class="input-checkbox input-checkbox-md"><label for="agree-term">I hereby agree to the <strong> exchange agreement &amp; terms</strong>.</label></div>

<!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><input type="submit" value="Confirm Exchange" class="btn btn-primary"> </li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal"  class="link link-primary">Cancel</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
<p class="lead text-primary"><strong>Your <a id="get5"></a> Address:</strong> <a id="getadd1"></a></p>

<p>To change your payment account or to receive into another Account, <a href="{{route('wallet')}}">Click Here</a>.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong payment account.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
</form>







@endsection
