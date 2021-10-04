@extends('include.admindashboard')

@section('body')


<script>
function goBack() {
  window.history.back()
}
</script>
   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{date('d M Y',strtotime($exchange->created_at))}}</span></div><div class="fake-class"><span class="data-details-title">Tranx Status</span> @if( $exchange->status ==2 )
                                                <span class="badge badge-success">Success</span>
                                            @elseif( $exchange->status == -2 )
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif</div><div class="fake-class"><span class="data-details-title">Tranx Time</span><span class="data-details-info"> {{$exchange->created_at}}</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Transaction Type</div><div class="data-details-des"><strong>Exchange</strong></div></li><!-- li --><li><div class="data-details-head">From</div><div class="data-details-des"><strong>{{$exchange->from_amount}} {{$exchange->fromCurrency->symbol}} <small>- What User Have</small></strong></div></li><!-- li --><li><div class="data-details-head">To</div><div class="data-details-des"><strong>{{$exchange->receive_amount}} {{$exchange->toCurrency->symbol}}<small>- What User Gets</small></strong></div></li><!-- li --><li><div class="data-details-head">Charge</div><div class="data-details-des"><span>{{$exchange->from_amount_charge}} {{$exchange->toCurrency->symbol}} {{$exchange->toCurrency->symbol}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">TRX Number</div><div class="data-details-des"><span>{{$exchange->trx}}</span> <span></span></div></li>


@if($exchange->type > 0)
<li><div class="data-details-head">Payment Number</div><div class="data-details-des"><span><strong>{{$exchange->transaction_number}}</strong></span></div></li>

<li><br><div class="data-details-head">Payment Screenshot</div>
<div class="data-doc-item data-doc-item-lg">
    <div class="data-doc-image"><img src="{{asset('exchange/'.$exchange->image)}}" alt="..." class="img-thumbnail"></div>
    <ul class="data-doc-actions"><li><a href="{{asset('exchange/'.$exchange->image)}}" download><em class="ti ti-import"></em></a></li></ul></div></li>


@endif<!-- li -->

<!-- li --><li><div class="data-details-head">Customer</div><div class="data-details-des"><span>{{$exchange->user->username}}</span> <span></span></div></li>

                                            <!-- li --><li><div class="data-details-head">Email</div><div class="data-details-des">{{$exchange->user->email}}</div></li><!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div><h6 class="card-sub-title">Payment Details</h6><ul class="data-details-list"><li><div class="data-details-head">Coin Name</div><div class="data-details-des"><strong>{{$exchange->toCurrency->name}}</strong></div></li><!-- li --><li><div class="data-details-head">Wallet Address</div><div class="data-details-des"><span><strong>{{$exchange->info}}</strong> <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{$exchange->toCurrency->name}} Wallet Address"></em></span> </div></li><!-- li --><li><div class="data-details-head">Units To Credit</div><div class="data-details-des"><strong>{{$exchange->receive_amount}} {{$exchange->toCurrency->symbol}} <small>- {{$exchange->toCurrency->name}}</small></strong></div></li></ul><!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div>
@endsection
@section('script')
@endsection
