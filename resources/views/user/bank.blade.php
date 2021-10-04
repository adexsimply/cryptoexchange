@extends('include.userdashboard')
@section('content')
  <div class="page-content"><div class="container"><div class="row"><div class="col-lg-12 main-content"><!-- Modal End -->








  <div class="mosdal fsade" id="get-pay-address" tabindex="-1"><div class="modal-dsialog modal-diaslog-md modal-disalog-centered"><div class="modal-content">






  <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-credit-card"></em></a><div class="popup-body">



 <div class="gaps-3x"></div><div class="card-head"></div><div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Bank Account</span> </h5><span>{{Auth::user()->bank}}</span></div></div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Paypal Address</span></h5><span>{{Auth::user()->paypal}}</span></div></div> </div></div>




  <h4 class="popup-title">Bank Account Setup</h4><p>Please Ensure You Setup Your Bank Account Status Here In Order To Be Eligible For Payment Via Bank Transfer.</p><div class="gaps-1x"></div><h6 class="font-bold">Enter Account Number</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<form method="post" action="{{route('post.banky') }}">
@csrf
  <input type="text" name="accountno" class="copy-address" value=""  ><button class="copy-trigger"><em class="ti ti-credit-card"></em></button></div>


<div class="gaps-1x"></div><h6 class="font-bold">Enter Account Number</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

 <select name="bank" class="select-bordered select-block">
	<option  selected>Select Bank</option>
<? $accounts = DB::table('localbanks')->get(); ?>
 @foreach($accounts as $accounts)
 <option value="{{$accounts->code}}">{{$accounts->bank}}</option>
@endforeach
</select></button></div>




  <div class="gaps-1x"></div><h6 class="font-bold">Paypal Address</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

  <input type="text" name="paypal" class="copy-address" value="{{Auth::user()->paypal}}" ><button class="copy-trigger"><em class="ti ti-money"></em></button></div>
<small> Please leave empty if you dont have a Paypal address
  <!-- .copy-wrap --><ul class="pay-info-list row"><li class="col-sm-6"></ul><!-- .pay-info-list --><div class="pdb-2-5x pdt-1-5x"><input required type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the {{$basic->sitename}} <a href="#"><strong > aggrement &amp; term</strong>.</a></label></div><button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#pay-confirm">Activate Bank Account  <em class="ti ti-arrow-right mgl-4-5x"></em></button>
</form>

<div class="gaps-3x"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>If your bank us not listed, please select other banks and Enter full details of your bank in the account number field</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>You can lock your bank account details from being changed via the settings menu.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End --</div></div></div><!-- .container --></div>
@stop
