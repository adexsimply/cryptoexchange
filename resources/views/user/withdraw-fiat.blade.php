@extends('include.userdashboard')
@section('content')
 <!-- .topbar-wrap --><div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Withdrawal Summary</h4></div><div class="card-text"><p>Please ensure you have double checked your withdrawal details before proceeding with withdrawal</p></div><div class="gaps-3x"></div><div class="card-head"><h5 class="card-title card-title-md">Withdrawal Gateway</h5></div><div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Withdrawal Method</span> </h5><span>Withdrawal Method: {!! $method->name !!}</span><span>Processing Period: {!! $method->duration !!} Day(s)</span></div></div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Withdrawal Charges</span></h5><span>Percentage CHarge: {!! $method->percent !!} %</span><span>Fixed Charge: {{$basic->currency_sym}}{!! $method->fix !!}</span></div></div></div></div><div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Amount</span></h5><span>Amount: {{$basic->currency_sym}} {{$amount}}</span><span>Charge: {{$basic->currency_sym}} {{$charge}}</span></div></div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Total</span></h5><span>{{$basic->currency_sym}} {{$charge + $amount}}</span></div></div><div class="col-xl-3 col-md-3 align-self-center text-xl-right"><div class="pdb-1x">
<form method="post" action="{{route('withdraw.submit')}}">
{{ csrf_field() }}
<input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
 <input name="send_details" value="d" hidden>
 <button type="submit" class="schedule-bonus">Submit Request</button></form></div></div></div></div><h6 class="text-light mb-0">Receiver's {{$method->name}} Account Details: <a href="#">fdsf</a></h6>                            </div></div></div></div></div><!-- .col --></div><!-- .container --></div><!-- .container --></div><!-- .page-content -->
@stop