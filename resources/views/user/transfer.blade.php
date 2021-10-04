@extends('include.userdashboard')
@section('content')
   <div class="page-content"><div class="container">


<div class="row">


<!-- Modal End --><div class="main-content col-lg-12" id="pay-confirm" tabindex="-1"><div class=" "><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Transfer Fund</h4><p class="lead text-primary">Your currently have  <strong>{{$basic->currency}} {{number_format(Auth::user()->balance, $basic->decimal)}} </strong> in your deposit wallet. </p><p>To transfer fund from your wallet to another user's wallet, enter the receiver's username and proceed to enter amount to transfer.</p><p>To <strong>ensure safe delivery</strong> of fund to user please enter <strong>a valid account username</strong> </p>
<form method="post" action="{{route('update.transfer') }}">
@csrf

<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Enter User's Username</label><input name="username" class="input-bordered" type="text" ></div>

<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Enter Amount</label><input name="amount" class="input-bordered" type="number" ></div>

<!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit"  class="btn btn-primary">Confirm Transfer</button></li>

</form>

<li class="pdt-1x pdb-1x"><a href="{{route('home')}}" class="link link-primary">Cancel Process</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>Do not make transfer to an unverified username.</p></div><div class="note note-plane note-danger"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->

</div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->

@stop
