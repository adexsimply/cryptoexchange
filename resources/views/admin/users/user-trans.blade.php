@extends('include.admindashboard')
@section('body')
<div class="page-content">
    <div class="container">
        <div class="card content-area">
            <div class="card-innr">
                <div class="card-head">
                    <h4 class="card-title">Transaction Log</h4>
                </div>
                <table class="data-table dt-init user-tnx">
                    <thead>
                        <tr class="data-item data-head">
                            <th class="data-col dt-tnxno">Transaction NO</th>
                            <th class="data-col dt-tnxno">Transaction Type</th>
                            <th class="data-col dt-token">Amount {{$basic->currency_sym}}</th>
                            <th class="data-col dt-amount">Amount ($)</th>
                            <th class="data-col dt-usd-amount">Charge</th>
                            <th class="data-col dt-type">
                                <div class="dt-type-text">Status</div>
                            </th>
                            <th class="data-col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($deposits) >0)
                        @foreach($deposits as $k=>$data)
                        <tr class="data-item">
                            <td class="data-col dt-tnxno">
                                <div class="d-flex align-items-center">
                                    @if($data->status == "Pending")
                                    <div class="data-state data-state-pending"><span class="d-none">Pending</span></div>
                                    @elseif($data->status == "Paid")
                                    <div class="data-state data-state-progress"><span class="d-none">Paid</span></div>
                                    @elseif($data->status == "Confirmed")
                                    <div class="data-state data-state-approved"><span class="d-none">Approved</span></div>
                                    @elseif($data->status == "Declined")
                                    <div class="data-state data-state-canceled"><span class="d-none">Declined</span></div>
                                    @elseif($data->status == "Cancelled")
                                    <div class="data-state data-state-canceled"><span class="d-none">Cancelled</span></div>
                                    @endif


                                    <div class="fake-class"><span class="lead tnx-id">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</span><span class="sub sub-date">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</span></div>
                                </div>
                            </td>
                            <td class="data-col dt-type">
                                <span class="lead token-amount">{{$data->type}}</span>
                            </td>
                            <td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></td>
                            <td class="data-col dt-amount"><span class="lead amount-pay">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></td>
                            <td class="data-col dt-usd-amount"><span class="lead amount-pay">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}} <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Transaction Charges"></em></span></td>
                            <td class="data-col dt-type">
                                @if( $data->status == "Confirmed" )
                                <span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
                                @elseif( $data->status == "Declined" )
                                <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">P</span>
                                @elseif( $data->status == "Pending" )
                                <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                @elseif( $data->status == "Paid" )
                                <span class="dt-type-md badge badge-outline badge-warning badge-md">Paid</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                @elseif( $data->status == "Cancelled" )
                                <span class="dt-type-md badge badge-outline badge-danger badge-md">Cancelled</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">C</span>
                                @endif
                            </td>
                            <td class="data-col text-right">
                                <div class="relative d-inline-block d-md-none"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                                    <div class="toggle-class dropdown-content dropdown-content-center-left pd-2x">
                                        <ul class="data-action-list">
                                            <li><a href="#" class="btn btn-auto btn-primary btn-xs" data-toggle="modal" data-target="#{{$data->trx}}"><span>View <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="data-action-list d-none d-md-inline-flex">
                                    <li><a href="#" data-toggle="modal" data-target="#A{{$data->id}}A" class="btn btn-auto btn-primary btn-xs"><span>View <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li>
                                </ul>
                            </td>
                        </tr>




                        <!-- Modal Large -->
                        <div class="modal fade" id="A{{$data->id}}A" tabindex="-1">
                            <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                                <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                                    <div class="popup-body popup-body-lg">
                                        <div class="content-area">
                                            <div class="card-head d-flex justify-content-between align-items-center">
                                                <h4 class="card-title mb-0">Transaction Details</h4>
                                            </div>
                                            <div class="gaps-1-5x"></div>
                                            <div class="data-details d-md-flex">
                                                <div class="fake-class"><span class="data-details-title">Transaction Date</span><span class="data-details-info">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</span></div>
                                                <div class="fake-class"><span class="data-details-title">Transaction Status</span>


                                                    @if( $data->status == "Confirmed" )
                                                    <span class="badge badge-success">Approved</span>
                                                    @elseif( $data->status == "Paid" )
                                                    <span class="badge badge-success">Paid</span>
                                                    @elseif( $data->status == "Declined" )
                                                    <span class="badge badge-danger">Declined</span>
                                                    @elseif( $data->status == "Cancelled" )
                                                    <span class="badge badge-danger">Cancelled</span>
                                                    @elseif( $data->status == "Pending" )
                                                    <span class="badge badge-warning">Pending</span>
                                                    @endif

                                                </div>
                                                <div class="fake-class"><span class="data-details-title">Payment Gateway</span><span class="data-details-info">{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}}</span></div>
                                            </div>
                                            <div class="gaps-3x"></div>
                                            <h6 class="card-sub-title">Transaction Info</h6>
                                            <ul class="data-details-list">
                                                <li>
                                                    <div class="data-details-head">Transaction Type</div>
                                                    <div class="data-details-des"><strong>
                                                            {{$data->type}}
                                                        </strong></div>
                                                </li>
                                                <li>
                                                    <div class="data-details-head">Transaction ID</div>
                                                    <div class="data-details-des"><span>{{$data->trx}}</span> <span></span></div>
                                                </li><!-- li -->
                                                <li>
                                                    <div class="data-details-head">Amount</div>
                                                    <div class="data-details-des" style="color:#21a184; font-weight: 600;">{!! $basic->currency_sym !!}{{number_format($data->amount, $basic->decimal)}}</div>
                                                </li>

                                                <li>
                                                    <div class="data-details-head">Charge</div>
                                                    <div class="data-details-des" style="color:#21a184; font-weight: 600;">{!! $basic->currency_sym !!}{{number_format($data->charge, $basic->decimal)}}</div>
                                                </li>

                                                <li>
                                                    <div class="data-details-head">Total Amount</div>
                                                    <div class="data-details-des" style="color:#21a184; font-weight: 600;">{!! $basic->currency_sym !!}{{number_format($data->amount+$data->charge, $basic->decimal)}}</div>
                                                </li>

                                                <li>
                                                    <div class="data-details-head">Amount USD</div>
                                                    <div class="data-details-des" style="color:#21a184; font-weight: 600;">${{number_format($data->currency_amount_usd, $basic->decimal)}}</div>
                                                </li>

                                                @if(isset($data->currency->name))
                                                <li>
                                                    <div class="data-details-head">Currency</div>
                                                    <div class="data-details-des">{{$data->currency->name}}</div>
                                                </li>
                                                @endif

                                                <!-- li -->
                                            </ul>

                                            @if($data->type == "Deposit")

                                            <div class="gaps-3x"></div>
                                            <h6 class="card-sub-title">Transaction Details</h6>
                                            <ul class="data-details-list">
                                                <li>
                                                    <div class="data-details-head">Gateway</div>
                                                    <div class="data-details-des">
                                                        {{$data->payment_method_id}}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="data-details-head">Payment Method</div>
                                                    <div class="data-details-des">
                                                        @if($data->payment_method_id == "Bank Transfer")
                                                        <span>{{isset($data->method->name) ? $data->method->name : 'N/A'}}</span>
                                                        @endif
                                                        @if($data->payment_method_id == "Online Payment")
                                                        <span>{{isset($data->gateway_id) ? $data->gateway->name : 'N/A'}}</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="data-details-head">Amount Paid</div>
                                                    <div class="data-details-des">
                                                        <b style="color:#21a184">{{ $basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</b>
                                                    </div>
                                                </li><!-- li -->
                                                @if(isset($data->trans_prove_num))
                                                <li>
                                                    <div class="data-details-head">Payment Prove Number</div>
                                                    <div class="data-details-des"><strong>{{$data->trans_prove_num}}</strong></div>
                                                </li><!-- li -->
                                                <!-- li -->
                                                @endif

                                                @if(isset($data->image))
                                                <li>
                                                    <div class="data-details-head">Payment Screensho</div>
                                                    <div class="data-details-des">
                                                        <a href="{{asset('transaction_proves/'.$data->image)}}" download="">
                                                            <img class="img-fluid" src="{{asset('transaction_proves/'.$data->image)}}" style="width:50px">
                                                        </a>
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                            @endif


                                            @if($data->type == "Sell")

                                            <div class="gaps-3x"></div>
                                            <h6 class="card-sub-title">Transaction Details</h6>
                                            <ul class="data-details-list">
                                                <li>
                                                    <div class="data-details-head">Amount Paid</div>
                                                    <div class="data-details-des">
                                                        <b style="color:#21a184">{{ $basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</b>
                                                    </div>
                                                </li><!-- li -->
                                                @if(isset($data->trans_prove_num))
                                                <li>
                                                    <div class="data-details-head">Payment Prove Number</div>
                                                    <div class="data-details-des"><strong>{{$data->trans_prove_num}}</strong></div>
                                                </li><!-- li -->
                                                <!-- li -->
                                                @endif

                                                @if(isset($data->image))
                                                <li>
                                                    <div class="data-details-head">Payment Screensho</div>
                                                    <div class="data-details-des">
                                                        <a href="{{asset('transaction_proves/'.$data->image)}}" download="">
                                                            <img class="img-fluid" src="{{asset('transaction_proves/'.$data->image)}}" style="width:50px">
                                                        </a>
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                            @endif

                                            @if(isset($data->bank))
                                            <div class="gaps-3x"></div>
                                            <h6 class="card-sub-title">Bank Account Details</h6>
                                            <ul class="data-details-list">
                                                <li>
                                                    <div class="data-details-head">Bank Name</div>
                                                    <div class="data-details-des"><span>{{$data->bank}}</span></div>
                                                </li>
                                                <li>
                                                    <div class="data-details-head">Account Name</div>
                                                    <div class="data-details-des"><span>{{$data->acc_name}}</span></div>
                                                </li>
                                                <li>
                                                    <div class="data-details-head">Account Number</div>
                                                    <div class="data-details-des"><span>{{$data->acc_num}}</span></div>
                                                </li>
                                                <!-- li -->
                                            </ul>

                                            @endif
                                        </div><!-- .modal-content -->
                                    </div><!-- .modal-dialog -->
                                </div><!-- Modal End -->
                                @endforeach
                                @endif

                                <!-- .data-item -->
                    </tbody>
                </table>
            </div><!-- .card-innr -->
        </div><!-- .card -->
    </div><!-- .container -->
</div><!-- .page-content -->
@stop