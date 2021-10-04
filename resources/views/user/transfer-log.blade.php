@extends('include.userdashboard')
@section('content')
    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Withdrawal Log</h4></div><table class="data-table dt-init user-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Tranx NO</th><th class="data-col dt-token">Amount</th><th class="data-col dt-amount">Receiver</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@if(count($transfer) >0)
 @foreach($transfer as $k=>$data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">
 @if($data->status == 2)
<div class="data-state data-state-approved">
@elseif($data->status == 1)
<div class="data-state data-state-pending">
@else
<div class="data-state data-state-canceled">
@endif

<span class="d-none">Pending</span></div><div class="fake-class"><span class="lead tnx-id">{{isset($data->transaction_id ) ? $data->transaction_id  : 'N/A'}}</span><span class="sub sub-date">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount"> {{$data->amount}}</span><span class="sub sub-symbol">{!! $basic->currency !!}</span></td><td class="data-col dt-amount"><span class="lead amount-pay"> {{$data->send_details}}</span></td><td class="data-col dt-type">
@if($data->status == 1)
<span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">S</span>
 @elseif($data->status == 2)
<span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
@elseif($data->status == -2)
<span class="dt-type-md badge badge-outline badge-sdanger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
@endif
</td><td class="data-col text-right"><div class="relative d-inline-block d-md-none"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-center-left pd-2x"><ul class="data-action-list"><li><a href="#" class="btn btn-auto btn-primary btn-xs" data-toggle="modal" data-target="#{{$data->transaction_id}}" ><span>View <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li></ul></div></div><ul class="data-action-list d-none d-md-inline-flex"><li><a href="#" data-toggle="modal" data-target="#{{$data->transaction_id}}"  class="btn btn-auto btn-primary btn-xs"><span>View <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li></ul></td></tr>




<!-- Modal Large --><div class="modal fade" id="{{$data->transaction_id}}" tabindex="-1"><div class="modal-dialog modal-dialog-lg modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body popup-body-lg"><div class="content-area"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</span></div><div class="fake-class"><span class="data-details-title">Tranx Status</span>

@if($data->status == 1)
<span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
 @elseif($data->status == 2)
<span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span>
@elseif($data->status == -2)
<span class="dt-type-md badge badge-outline badge-sdanger badge-md">Declined</span>
@endif


</div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Transaction Type</div><div class="data-details-des"><strong>Transfer</strong></div></li><!-- li --

<li><div class="data-details-head">Tx Hash</div><div class="data-details-des"><span>{{$data->transaction_id}}</span> <span></span></div></li>





<!-- li --><li><div class="data-details-head">Transaction ID</div><div class="data-details-des"><span>{{$data->transaction_id}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Amount Transfered</div><div class="data-details-des">{!! $basic->currency !!} {{$data->amount}}</div></li>
<li><div class="data-details-head">Receiver</div><div class="data-details-des">{{$data->send_details}}</div></li>


<!-- li --></ul></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
 @endforeach
 @endif

 <!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@stop
