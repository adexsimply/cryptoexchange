@extends('include.admindashboard')

@section('body')

<script>
function goBack() {
  window.history.back()
}
</script>


<div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Request Date</span><span class="data-details-info">{{$data->created_at}}</span></div><div class="fake-class"><span class="data-details-title">Request Status</span>


 @if($data->status == 1)
            <span  class="badge  badge-pill  badge-success "> Approved </span>
                                        @elseif($data->status == 0)
            <span class="badge  badge-pill  badge-warning ">Pending </span>
                                        @elseif($data->status == -2)
            <span class="badge  badge-pill  badge-danger ">Refund </span>
                                        @endif



</div><div class="fake-class"><span class="data-details-title">Username</span><span class="data-details-info">  <strong>{{$data->user->username}}</strong> ({{$data->user->email}})</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Transaction Type</div><div class="data-details-des"><strong>Deposit</strong></div></li><!-- li --><li><div class="data-details-head">Payment Gateway</div><div class="data-details-des"><strong>@if($data->gateway_id == 0) Bank Transfer @else {{$data->gateway->name }} @endif <small>- Payment Method</small></strong></div></li><!-- li --><li><div class="data-details-head">Amount</div><div class="data-details-des"><strong>{!! number_format($data->amount, $basic->decimal)  !!} {{$basic->currency}}</strong></div></li><!-- li --><li><div class="data-details-head">Deposit Charge</div><div class="data-details-des"><span>{!! number_format($data->charge, $basic->decimal)  !!}{{$basic->currency}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Total Amount</div><div class="data-details-des"><span>{!! number_format($data->usd, $basic->decimal)  !!}{{$basic->currency}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">TRX ID</div><div class="data-details-des">{{$data->trx}}</div></li>

@if($data->gateway_id == 0)
</li><!-- li --><li><div class="data-details-head">Payment Number</div><div class="data-details-des">{{$data->code}}</div></li></li><!-- li --><li><div class="data-details-head">Payment Screenshot</div><div class="data-details-des">

<img src="{{asset('uploads/payments/'.$data->image)}}" alt="..." class="img-thumbnail">
</div></li>
@endif


<!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div> <!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
