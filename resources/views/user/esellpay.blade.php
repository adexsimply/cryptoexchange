@extends('include.userdashboard')

@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="main-content col-lg-12">
                <div class="content-area card">
                    <div class="card-innr">
                        <h4>READ BEFORE YOU PROCEED WITH SALE</h4>
                        <ul class='list-group text-secondary'>
                            <li class='notice list-group-item'>
                                Amount Payable {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}.
                            </li>

                            <li class='notice list-group-item'>
                                Do not send below the required amount of {{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (USD{{number_format($data->amount, $basic->decimal)}}).
                            </li>

                            <li class="notice list-group-item">
                                {{$basic->sitename}} will not be responsible for funding a wrong account number provided by you
                            </li>

                        </ul>
                        <div class="token-overview-wrap">
                            <div class="token-overview">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="token-bonus token-bonus-sale"><span class="token-overview-title">{{$data->bankname}}</span><span class="token-overview-value text-primary">Bank Name</span></div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="token-bonus token-bonus-samount"><span class="token-overview-title">{{$data->accountname}}</span><span class="token-overview-value text-primary">Account Name</span></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="token-total"><span class="token-overview-title font-bold">{{$data->accountnumber}}</span><span class="token-overview-value schedule-titl text-primary">Account Number</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="note note-plane note-danger note-sm pdt-1x pl-0">
                                <p>Do not pay below {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}} After payment, click Confirm Payment button below and fill/upload your payment information.</p>
                            </div>
                        </div>




                        <div class="pdb-1x">
                            <h5 class="schedule-title"><span>Amount Payable</span></h5><span class="schedule-title text-secondary">{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</span>
                            <br>
                            <a href="{{ route('esellscan',$data->trx) }}"><span class="schedule-bonus">Proceed To Sell</span></a>

                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div><!-- .container -->
</div>



@endsection