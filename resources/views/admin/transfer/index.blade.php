@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Transfer Log</h4></div>


   <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Username</th><th class="data-col dt-token">Amount</th>  <th class="data-col dt-account">TRX ID</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($data as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-approved"><span class="d-none">Approved</span></div><div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',$data->user->id)}}">
                                            {{$data->user->username}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{!! number_format($data->amount, $basic->decimal)  !!}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td> <td class="data-col dt-account"><span class="lead user-info"> {{$data->transaction_id}}</span> </td><td class="data-col dt-type"><span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span></td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('transfer.view',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li><li><a href="{{route('transfer.delete',$data->id)}}"><em class="ti ti-trash"></em> Delete</a></li> </ul></div></div></td></tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>
@endsection
