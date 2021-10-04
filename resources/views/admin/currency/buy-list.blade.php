@extends('include.admindashboard')

@section('body')


<div class="page-content">
    <div class="container">
        <div class="content-area card">
            <div class="card-innr">
                <div class="card-head">
                    <h4 class="card-title">Purchase Log</h4>
                </div>


                <table class="data-table dt-filter-init admin-tnx">
                    <thead>
                        <tr class="data-item data-head">
                            <th class="data-col dt-tnxno">Buyer</th>
                            <th class="data-col dt-token">{{$basic->currency}}</th>
                            <th class="data-col dt-token">USD</th>
                            <th class="data-col dt-account">Currency</th>
                            <th class="data-col dt-type">
                                <div class="dt-type-text">Status</div>
                            </th>
                            <th class="data-col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($exchange as $k=>$data)
                        <tr class="data-item">
                            <td class="data-col dt-tnxno">
                                <div class="d-flex align-items-center">


                                    @if( $data->status == "Confirmed" )
                                    <div class="data-state data-state-approved"><span class="d-none">Approved</span></div>
                                    @elseif( $data->status == "Declined" )
                                    <div class="data-state data-state-canceled"><span class="d-none">Rejected</span></div>
                                    @elseif( $data->status == "Pending" )
                                    <div class="data-state data-state-pending"><span class="d-none">Pending</span></div>
                                    @elseif( $data->status == "Paid" )
                                    <div class="data-state data-state-progress"><span class="d-none">Paid</span></div>
                                    @endif




                                    <div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',$data->user->id)}}">
                                                {{$data->user->username}}
                                            </a></span><span class="sub sub-date">{{$data->created_at}}</span></div>
                                </div>
                            </td>
                            <td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td>
                            <td class="data-col dt-token"><span class="lead amount-pay">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span><span class="sub sub-symbol">USD <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="${{number_format($data->currency_amount_usd, $basic->decimal)}} of {{$data->currency->name}}"></em></span></td>
                            <td class="data-col dt-account"><span class="lead user-info">{{$data->currency->name}}</span> </td>


                            <td class="data-col dt-type">
                                @if( $data->status == "Confirmed" )
                                <span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
                                @elseif( $data->status == "Declined" )
                                <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">P</span>
                                @elseif( $data->status == "Pending" )
                                <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                @elseif( $data->status == "Paid" )
                                <span class="dt-type-md badge badge-outline badge-warning badge-md">Paid</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                @endif
                            </td>

                            <td class="data-col text-right">
                                <div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                                    <div class="toggle-class dropdown-content dropdown-content-top-left">
                                        <ul class="dropdown-list">
                                            <li><a href="{{route('buy-info',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li>

                                            @if($data->status == "Confirmed" && $data->image)
                                            <li><a data-toggle="modal" data-target="#pove-modal{{$data->id}}" href="#"><em class="ti ti-check-box"></em> Re-upload Proof</a></li>
                                            @endif

                                            @if($data->status == "Confirmed" && $data->image == Null)
                                            <li><a data-toggle="modal" data-target="#pove-modal{{$data->id}}" href="#"><em class="ti ti-check-box"></em> Upload Proof</a></li>
                                            @endif
                                            @if($data->status == "Pending")
                                            <li><a href="{{route('buy.approve',$data->id)}}"><em class="ti ti-check-box"></em> Approve</a></li>
                                            <li><a href="{{route('buy.reject',$data->id)}}"><em class="ti ti-na"></em> Decline</a></li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr><!-- .data-item -->

                        <!-- Modal -->
                        <div class="modal fade" id="pove-modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Proof for <b>{{$data->user->username}}</b> Purchase</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('buy-send-prove') }}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="modal-body">
                                            <input type="hidden" value="{{$data->id}}" name="trans_id">
                                            <input type="hidden" value="{{$data->user->id}}" name="user_id">
                                            <label>Upload Purchase Proof File</label>
                                            <input type="file" name="prove" class="form-control" accept="image/*">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- .data-item -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
@endsection