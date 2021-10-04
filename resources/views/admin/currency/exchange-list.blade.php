@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Exchange Log</h4></div>


   <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Buyer</th><th class="data-col dt-token">From</th><th class="data-col dt-amount">To</th> <th class="data-col dt-account">Currency</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($exchange as $k=>$data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">


  @if( $data->status ==2 )
                                            <div class="data-state data-state-approved"><span class="d-none">Approved</span></div>
                                        @elseif( $data->status == -2 )
                                            <div class="data-state data-state-canceled"><span class="d-none">Rejected</span></div>
                                        @else
                                            <div class="data-state data-state-pending"><span class="d-none">Pending</span></div>
                                        @endif




<div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',$data->user->id)}}">
                                            {{$data->user->username}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$data->from_amount}} </span><span class="sub sub-symbol">{{$data->fromCurrency->symbol}}</span></td><td class="data-col dt-amount"><span class="lead amount-pay">{{$data->receive_amount}} </span><span class="sub sub-symbol">{{$data->toCurrency->symbol}} <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="{{$data->toCurrency->name}}"></em></span></td><td class="data-col dt-account"><span class="lead user-info">{{$data->toCurrency->name}}</span> </td>


 <td class="data-col dt-type">
  @if( $data->status ==2 )
<span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
     @elseif( $data->status == -2 )
<span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">P</span>
                                        @else
<span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                        @endif
</td>

<td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('exchange-info',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li>

@if($data->status == 1)
<li><a href="{{route('exchange.approve',$data->id)}}"><em class="ti ti-check-box"></em> Approve</a></li>

<li><a href="{{route('exchange.reject',$data->id)}}"><em class="ti ti-na"></em> Decline</a></li>
@endif

</ul></div></div></td></tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>
@endsection
