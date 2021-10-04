@extends('include.userdashboard')
@section('content')
<style>
  .error {
    color: red;
  }
</style>
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="card-head">
              <h4 class="card-title">Deposit Transaction Preview</h4>
            </div>
            <div class="schedule-item">
              <div class="card-text">
                <p>Find below the summary of your <b>Deposit Transaction Details</b>. {{$basic->sitename}} will not be liable to any loss arising from wrong account information.</p>
                <p>You can cancel this operation by clicking the button below</p>

                <div class="pdb-1x">
                  <a href="{{ route('cancel-deposit',$data->trx) }}" onclick="return confirm('Are you sure you want to Cancelled this Deposit Transaction?')"><span class="schedule-bonus" style="color:red">Cancel Deposit</span></a>
                </div>
              </div>
              <hr>
              <div class="gaps-3x"></div>
            </div>
            <div class="card-head">
              <h5 class="card-title card-title-md">Transaction Summary</h5>
            </div>
            @if($data->payment_method_id == "Bank Transfer")            
            <div class="schedule-item">
              <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Amount </span> </h5>
                    <b><span style="color:#21a184">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}} </span></b>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Payment Gateway</span></h5>
                    <span>Payment Gateway:<b style="color:#21a184"> {{$data->payment_method_id}}</b></span>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Payment Method</span></h5>
                    <span>Payment Method:<b style="color:#21a184"> {{$data->method->name}}</b></span>
                  </div>
                </div>
              </div>
            </div>
            @endif
            
            @if($data->payment_method_id == "Online Payment")            
            <div class="schedule-item">
              <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Amount </span> </h5>
                    <b><span style="color:#21a184">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}} </span></b>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Payment Gateway</span></h5>
                    <span>Payment Gateway:<b style="color:#21a184"> {{$data->payment_method_id}}</b></span>
                    <span><b style="color:#21a184">Credit/Debit Card</b></span>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Payment Method</span></h5>
                    <span>Payment Method:<b style="color:#21a184"> {{$data->gateway->name}}</b></span>
                  </div>
                </div>
              </div>
            </div>
            @endif
            <div class="schedule-item">
              <div class="row">
                <div class="col-xl-3 col-md-3 align-self-center text-xl-left">
                  <div class="pdb-1x">
                    <a href="{{ route('confirm_deposit', $data->trx) }}" onclick="return confirm('Are you sure you want to Proceed with this Deposit Transaction?')"><span class="schedule-bonus">Proceed With Payment</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection