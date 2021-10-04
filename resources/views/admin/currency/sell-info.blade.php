@extends('include.admindashboard')

@section('body')


<script>
    function goBack() {
        window.history.back()
    }
</script>

<div class="page-content">
    <div class="container">
        <div class="card content-area">
            <div class="card-innr">
                <div class="card-head d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a>
                </div>
                <div class="gaps-1-5x"></div>
                <div class="data-details d-md-flex">
                    <div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{date('d M Y',strtotime($exchange->created_at))}}</span></div>
                    <div class="fake-class"><span class="data-details-title">Tranx Status</span>
                        @if( $exchange->status == "Confirmed" )
                        <span class="badge badge-success">Approved</span>
                        @elseif( $exchange->status == "Paid" )
                        <span class="badge badge-success">Paid</span>
                        @elseif( $exchange->status == "Declined" )
                        <span class="badge badge-danger">Declined</span>
                        @elseif( $exchange->status == "Cancelled" )
                        <span class="badge badge-danger">Cancelled</span>
                        @elseif( $exchange->status == "Pending" )
                        <span class="badge badge-warning">Pending</span>
                        @endif
                    </div>
                    <div class="fake-class"><span class="data-details-title">Tranx Time</span><span class="data-details-info"> {{$exchange->created_at}}</span></div>
                </div>
                <div class="gaps-3x"></div>

                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head">Transaction Type</div>
                        <div class="data-details-des"><strong>Sale</strong></div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Transaction ID</div>
                        <div class="data-details-des"><span>{{$exchange->trx}} </span> <span></span></div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Amount {{$basic->currency}}</div>
                        <div class="data-details-des"><strong>{{$basic->currency_sym}}{{number_format($exchange->amount, $basic->decimal)}}</strong>
                        </div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Transaction Charge</div>
                        <div class="data-details-des"><strong>{{$basic->currency_sym}}{{number_format($exchange->charge, $basic->decimal)}} <small></small></strong></div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Sell Rate</div>
                        <div class="data-details-des"><strong>{{$basic->currency_sym}}{{number_format($exchange->currency_rate, $basic->decimal)}} <small></small></strong>
                            <span>({{$basic->currency_sym}}{{number_format($exchange->currency_rate, $basic->decimal)}} {{$basic->currency}} / $1)</span>
                        </div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Amount In USD</div>
                        <div class="data-details-des"><span>${{number_format($exchange->currency_amount_usd, $basic->decimal)}}</span> <span></span></div>
                    </li>
                </ul><!-- .data-details -->
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">Transaction Details</h6>
                <ul class="data-details-list">

                    <li>
                        <div class="data-details-head">Cryptocurrency</div>
                        <div class="data-details-des"><strong>{{$exchange->currency->name}}</strong></div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Amount Paid</div>
                        <div class="data-details-des"><span><strong>{{$basic->currency_sym}}{{number_format($exchange->amount, $basic->decimal)}}</strong> </span> </div>
                    </li><!-- li -->
                    @if(isset($exchange->trans_prove_num))
                    <li>
                        <div class="data-details-head">Payment Prove Number</div>
                        <div class="data-details-des"><strong>{{$exchange->trans_prove_num}}</strong></div>
                    </li><!-- li -->
                    <!-- li -->
                    @endif

                    @if(isset($exchange->image))
                    <li>
                        <div class="data-details-head">Payment Screensho</div>
                        <div class="data-details-des">
                            <a href="{{asset('transaction_proves/'.$exchange->image)}}" download="">
                                <img class="img-fluid" src="{{asset('transaction_proves/'.$exchange->image)}}" style="width:50px">
                            </a>
                        </div>
                    </li>
                    @endif
                    <!-- li -->
                </ul><!-- .data-details -->
            </div>
        </div><!-- .card -->
    </div><!-- .container -->
</div>
@endsection
@section('script')
@endsection