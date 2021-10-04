@extends('include.userdashboard')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-12">
        <div class="content-area card">
          <div class="card-innr">
            <div class="card-head">
              <h4 class="card-title">Transaction Preview</h4>
            </div>
            <div class="card-text">
              <p>Find below the summary of your {{$data->currency->name}} purchase. {{$basic->sitename}} will not be liable to any loss arising from wrong wallet address, or reduction in {{$data->currency->name}} price rate</p>
              <p>You can cancel this operation by clicking <a href="{{ route('ebuydel',$data->trx) }}">here</a></p>
            </div>
            <div class="gaps-3x"></div>
            <div class="card-head">
              <h5 class="card-title card-title-md">Currency Summary</h5>
            </div>

            <div class="schedule-item">
              <div class="row">
                <div class="col-xl-5 col-md-5 col-lg-6">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Amount In USD</span> </h5><span>{{number_format($data->amount, $basic->decimal)}} USD</span><span>1{{$data->currency->symbol}} = ${{number_format($data->currency->price, $basic->decimal)}}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-md col-lg-6">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Amount In {{$basic->currency}}</span></h5><span>{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</span><span>$1.00 = {{$basic->currency_sym}}{{number_format($data->currency->buy, $basic->decimal)}}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="schedule-item">
              <div class="row">
                <div class="col-xl-5 col-md-5 col-lg-6">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>Payment Gateway</span> </h5>

                    @if($data->gateway)
                    <span>

                      {{App\Gateway::whereId($data->gateway)->first()->name}}</span>

                    @else
                    <span>Payment Method:

                      {{App\PaymentMethod::whereId($data->method)->first()->name}}</span><span>Bank: {{App\Bank::whereId($data->bank)->first()->name}}</span>
                    @endif
                  </div>
                </div>
                <div class="col-xl-4 col-md col-lg-6">
                  <div class="pdb-1x">
                    <h5 class="schedule-title"><span>{{$data->currency->name}} Wallet Address</span></h5><span>{{$data->wallet}}</span><span> </span>
                  </div>
                </div>
                <div class="col-xl-3 col-md-3 align-self-center text-xl-right">
                  <div class="pdb-1x">
                    <a href="{{ route('ebuypost',$data->trx) }}"><span class="schedule-bonus">Proceed With Payment</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- .container -->
    </div>@endsection