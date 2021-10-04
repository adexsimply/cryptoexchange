@extends('include.userdashboard')
@section('content')
   <div class="page-content"><div class="container">


<div class="row">


<!-- Modal End --><div class="main-content col-lg-12" id="pay-confirm" tabindex="-1"><div class=" "><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Convert Bonus</h4><p class="lead text-primary">Your currently have  <strong>{{$basic->currency}} {{number_format(Auth::user()->bonus, $basic->decimal)}} </strong> in your bonus wallet but it is not spendable. </p>
<div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>To make bonus spendable, enter the amount of bonus you want to convert to spendable, this is credited to your deposit wallet upon successful conversion.</p></div>

<div class="note note-plane note-danger mgb-1x"><em class="fas fa-info-circle"></em><p>Please note that the minimum amount you can convert to you deposit wallet is {{$basic->currency}}{{number_format($basic->minbonus, $basic->decimal)}}. Ensure you have earned up to that before you proceed</p></div>

<div class="note note-plane note-danger"></div>


<p></p>
<form method="post" action="{{route('update.convert') }}">
@csrf


<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Enter Amount</label><input required  name="amount" class="input-bordered" type="number" ></div>

<!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit"  class="btn btn-primary">Confirm Conversion</button></li>

</form>

<li class="pdt-1x pdb-1x"><a href="{{route('home')}}" class="link link-primary">Cancel Process</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->

</div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->

@stop
