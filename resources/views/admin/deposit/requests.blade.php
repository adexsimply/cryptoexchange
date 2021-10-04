@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Pending Deposits</h4></div>


   <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Username</th><th class="data-col dt-token">Amount</th><th class="data-col dt-amount">TRX ID</th> <th class="data-col dt-account">Method</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($deposits as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-pending"><span class="d-none">Pending</span></div><div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',$data->user->id)}}">
                                            {{$data->user->username}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{!! number_format($data->amount, $basic->decimal)  !!}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td><td class="data-col dt-amount"><span class="lead amount-pay">{{$data->trx}}</span><span class="sub sub-symbol">  <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="1 ETH = 100 TWZ"></em></span></td><td class="data-col dt-account"><span class="lead user-info">@if($data->gateway_id == 0) Bank Transfer @else {{$data->gateway->name }} @endif</span> </td><td class="data-col dt-type"><span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span></td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('deposit.view',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li><li><a href="{{route('deposit.approve', $data->id)}}"><em class="ti ti-check"></em> Approve</a></li>
<li><a href="{{route('deposit.destroy',$data->id)}}"><em class="ti ti-na"></em> Decline</a></li>
</ul></div></div></td></tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>
@endsection
