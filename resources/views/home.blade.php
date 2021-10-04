@extends('include.userdashboard')
@section('content')
<div class="page-content">
        <div class="container">

                @php
                $ip = \App\UserLogin::whereUser_id(Auth::user()->id)->latest()->take(1)->first();
                $ncount = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();

                $ipcount = \App\UserLogin::whereUser_id(Auth::user()->id)->count();
                @endphp
                @if($ncount > 0)
                <div class="alert alert-info alert-dismissible fade show">Hello {{Auth::User()->username}}!, You have {{$ncount}} unread message(s). Please <a href="{{route('inbox')}}">Click Here</a> to open your inbox<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                @endif


                <div class="row">
                        <div class="col-lg-4">
                                <div class="token-statistics bg-secondary card card-token height-auto">
                                        <div class="card-innr">
                                                <div class="token-balance token-balance-with-iconx">

                                                        <h6 class="card-sub-title">Account Details</h6>

                                                        <div class="">
                                                                <div class="token-balance token-balance-with-icon mb-3">
                                                                        <div class="token-balance-icon"><em class="h2 color-white fa fa-money-bill"></em></div>
                                                                        <div class="token-balance-text">
                                                                                <h6 class="card-sub-title">Naira Wallet Balance</h6><span class="lead"> {{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</span>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <!-- <div class="token-balance-icon">
                                                        <em class="h2 color-white ti ti-user"></em>
                                                        </div> -->
                                                        <!-- <div class="token-balance-text">
                                                                <span class="lead">{{Auth::user()->username}} <span>
                                                        </div> -->


                                                </div>
                                                <div class="token-balance token-balance-s2">
                                                        <h6 class="card-sub-title">Summary</h6>
                                                        <ul class="token-balance-list">
                                                                <li class="token-balance-sub"><span class="leasd">{{ Carbon\Carbon::parse(Auth::User()->created_at)->diffForHumans() }}</span><span class="sub">Date Joined</span></li>
                                                                <li class="token-balance-sub"><span class="leasd">@if(Auth::user()->verified !=2) Unverified @elseif(Auth::user()->verified == 2)Verified @endif</span><span class="sub">Account Status</span></li>

                                                                <li class="token-balance-sub"><span class="leasd">
                                                                                @if($ipcount > 0)
                                                                                {{$ip->user_ip}}
                                                                                @else
                                                                                1:
                                                                                @endif
                                                                        </span><span class="sub">Login IP</span></li>
                                                        </ul>

                                                        <marquee>Current Location:
                                                                @if($ipcount > 0)
                                                                {{$ip->location}}
                                                                @else
                                                                Unknown
                                                                @endif
                                                        </marquee>
                                                </div>
                                        </div>
                                </div>
                        </div><!-- .col -->
                        <div class="col-lg-4">
                                <div class="token-statistics  card card-token height-auto">
                                        <div class="card-innr">
                                                <div class="token-balance token-balance-with-icon">
                                                        <div class="token-balance-icon"><em class="h2 color-white ti ti-shopping-cart"></em></div>
                                                        <div class="token-balance-text">
                                                                <h6 class="card-sub-title">Total Deposit</h6><span class="lead"> {{$basic->currency_sym}}{{number_format($deposit, $basic->decimal)}}</span>
                                                        </div>
                                                </div>
                                                <div class="token-balance token-balance-s2">
                                                        <h6 class="card-sub-title">Your Purchase</h6>
                                                        <ul class="token-balance-list">
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($deposit_pending, $basic->decimal)}}</span><span class="sub">Pending</span></li>
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($deposit_declined, $basic->decimal)}}</span><span class="sub">Declined</span></li>
                                                        </ul>
                                                </div>
                                        </div>
                                </div>
                        </div><!-- .col -->

                        <div class="col-lg-4">
                                <div class="token-statistics  card card-token height-auto">
                                        <div class="card-innr">
                                                <div class="token-balance token-balance-with-icon">
                                                        <div class="token-balance-icon"><em class="h2 color-white ti ti-shopping-cart"></em></div>
                                                        <div class="token-balance-text">
                                                                <h6 class="card-sub-title">Total Withdraw</h6><span class="lead"> {{$basic->currency_sym}}{{number_format($withdraw, $basic->decimal)}}</span>
                                                        </div>
                                                </div>
                                                <div class="token-balance token-balance-s2">
                                                        <h6 class="card-sub-title">Your Purchase</h6>
                                                        <ul class="token-balance-list">
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($withdraw_pending, $basic->decimal)}}</span><span class="sub">Pending</span></li>
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($withdraw_declined, $basic->decimal)}}</span><span class="sub">Declined</span></li>
                                                        </ul>
                                                </div>
                                        </div>
                                </div>
                        </div><!-- .col -->
                </div>
                <div class="row">
                        <div class="col-lg-6">
                                <div class="token-statistics  card card-token height-auto">
                                        <div class="card-innr">
                                                <div class="token-balance token-balance-with-icon">
                                                        <div class="token-balance-icon"><em class="h2 color-white ti ti-shopping-cart"></em></div>
                                                        <div class="token-balance-text">
                                                                <h6 class="card-sub-title">Total Crypto Purchase</h6><span class="lead"> {{$basic->currency_sym}}{{number_format($coin_bought, $basic->decimal)}}</span>
                                                        </div>
                                                </div>
                                                <div class="token-balance token-balance-s2">
                                                        <h6 class="card-sub-title">Your Purchase</h6>
                                                        <ul class="token-balance-list">
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($buy_pending, $basic->decimal)}}</span><span class="sub">Pending</span></li>
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($buy_declined, $basic->decimal)}}</span><span class="sub">Declined</span></li>
                                                        </ul>
                                                </div>
                                        </div>
                                </div>
                        </div><!-- .col -->
                        <div class="col-lg-6">
                                <div class="token-statistics bg-primary card card-token height-auto">
                                        <div class="card-innr">
                                                <div class="token-balance token-balance-with-icon">
                                                        <div class="token-balance-icon"><em class="h2 color-white ti ti-share"></em></div>
                                                        <div class="token-balance-text">
                                                                <h6 class="card-sub-title">Total Crypto Sales</h6><span class="lead"> {{$basic->currency_sym}}{{number_format($coin_sales, $basic->decimal)}}</span>
                                                        </div>
                                                </div>
                                                <div class="token-balance token-balance-s2">
                                                        <h6 class="card-sub-title">Your Sales</h6>
                                                        <ul class="token-balance-list">
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($sales_pending, $basic->decimal)}}</span><span class="sub">Pending</span></li>
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($sales_declined, $basic->decimal)}}</span><span class="sub">Declined</span></li>
                                                                <li class="token-balance-sub"><span class="lead pr-2">{{$basic->currency_sym}}{{number_format($sales_paid, $basic->decimal)}}</span><span class="sub">Paid</span></li>
                                                        </ul>
                                                </div>
                                        </div>
                                </div>
                        </div><!-- .col -->







                        <div class="col-xl-8 col-lg-7">
                                <div class="token-transaction card card-full-height">
                                        <div class="card-innr">
                                                <div class="card-head has-aside">
                                                        <h4 class="card-title">Recent Transactions</h4>
                                                        <div class="card-opt"><a href="{{route('transaction')}}" class="link ucap">View ALL <em class="fas fa-angle-right ml-2"></em></a></div>
                                                </div>
                                                <table class="data-table dt-init user-dtnx table-responsive">
                                                        <thead>
                                                                <tr class="data-item data-head">
                                                                        <th class="data-col dt-tnxno">Tranx NO</th>
                                                                        <th class="data-col dt-token">Currency</th>
                                                                        <th class="data-col dt-token">Amount</th>
                                                                        <!-- <th class="data-col dt-usd-amount">Rate</th>
                                                                        <th class="data-col dt-account">Payment Method</th> -->
                                                                        <th class="data-col dt-type" colspan="1">
                                                                                <div class="dt-type-text text-center">Status</div>
                                                                        </th>
                                                                        <th class="data-col">
                                                                                Action
                                                                        </th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>


                                                                @if(count($trx) >0)
                                                                @foreach($trx as $k=>$data)
                                                                <tr class="data-item">
                                                                        <td class="data-col dt-tnxno">
                                                                                <div class="d-flex align-items-center">
                                                                                        @if($data->status == "Pending")
                                                                                        <div class="data-state data-state-pending"><span class="d-none">Pending</span></div>
                                                                                        @elseif($data->status == "Paid")
                                                                                        <div class="data-state data-state-progress"><span class="d-none">Progress</span></div>
                                                                                        @elseif($data->status == "Confirmed")
                                                                                        <div class="data-state data-state-approved"><span class="d-none">Approved</span></div>
                                                                                        @elseif($data->status == "Declined")
                                                                                        <div class="data-state data-state-canceled"><span class="d-none">Declined</span></div>
                                                                                        @elseif($data->status == "Cancelled")
                                                                                        <div class="data-state data-state-canceled"><span class="d-none">Cancelled</span></div>
                                                                                        @endif

                                                                                        <div class="fake-class"><span class="lead tnx-id">{{$data->trx}}</span><span class="sub sub-date">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span></div>
                                                                                </div>
                                                                        </td>
                                                                        <td class="data-col dt-token"><span class="lead token-amount">
                                                                                        @if(isset($data->currency))
                                                                                        {{$data->currency->name}}
                                                                                        @else
                                                                                        Naira Wallet
                                                                                        @endif
                                                                                </span><span class="sub sub-symbol">{{$data->type}}</span></td>
                                                                        <td class="data-col dt-token"><span class="lead amount-pay">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span>
                                                                                <span class="sub sub-symbol">{{$basic->currency}}
                                                                                        <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}"></em>
                                                                                </span>
                                                                        </td>

                                                                        <td class="data-col dt-type" style="display: inline-flex;">
                                                                                @if($data->status == "Pending")
                                                                                <span class="dt-type-md badge badge-outline badge-warning badge-sm">Pending</span>
                                                                                @elseif($data->status == "Paid")
                                                                                <span class="dt-type-md badge badge-outline badge-warning badge-md">Paid</span>
                                                                                &nbsp;&nbsp
                                                                                <span class="dt-type-md badge badge-outline badge-success badge-sm"><i class="fa fa-spinner fa-spin"></i>&nbsp;Awaiting Approval</span>
                                                                                @elseif($data->status == "Confirmed")
                                                                                <span class="dt-type-md badge badge-outline badge-success badge-sm">Approved</span>
                                                                                @elseif($data->status == "Declined")
                                                                                <span class="dt-type-md badge badge-outline badge-danger badge-sm">Declined</span>
                                                                                @elseif($data->status == "Cancelled")
                                                                                <span class="dt-type-md badge badge-outline badge-danger badge-sm">Cancelled</span>
                                                                                @endif
                                                                                &nbsp;&nbsp

                                                                                @if($data->type == "Deposit")
                                                                                @if($data->status == "Pending")
                                                                                <ul class="data-action-list">
                                                                                        <li><a href="{{ route('confirm_deposit',$data->trx) }}" class="btn btn-auto btn-primary btn-xs"><span>Pay <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li>
                                                                                        <!-- <li><a href="{{ route('eselldel', $data->trx) }}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li> -->
                                                                                </ul>
                                                                                @endif
                                                                                @endif

                                                                                @if($data->type == "Sell")
                                                                                @if($data->status == "Pending")
                                                                                <ul class="data-action-list">
                                                                                        <li><a href="{{ route('sell_get',$data->trx) }}" class="btn btn-auto btn-primary btn-xs"><span>Sell <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a></li>
                                                                                        <!-- <li><a href="{{ route('eselldel', $data->trx) }}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li> -->
                                                                                </ul>
                                                                                @endif
                                                                                @endif
                                                                        </td>

                                                                        <td>
                                                                                <ul class="data-action-list">
                                                                                        <li><a href="#" data-toggle="modal" data-target="#transaction-{{$data->id}}details" class="btn btn-primary-alt btn-xs btn-icon"><em class="ti ti-eye"></em></a></li>
                                                                                </ul>
                                                                                </ul>
                                                                        </td>
                                                                </tr>


                                                                <!-- Modal Large -->
                                                                <div class="modal fade" id="transaction-{{$data->id}}details" tabindex="-1">
                                                                        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                                                                                <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                                                                                        <div class="popup-body popup-body-lg">
                                                                                                <div class="content-area">
                                                                                                        <div class="card-head d-flex justify-content-between align-items-center">
                                                                                                                <h4 class="card-title mb-0">Transaction Details</h4>
                                                                                                        </div>
                                                                                                        <div class="gaps-1-5x"></div>
                                                                                                        <div class="data-details d-md-flex">
                                                                                                                <div class="fake-class"><span class="data-details-title">Transaction Date</span><span class="data-details-info">{!! date(' D-d-M-Y', strtotime($data->created_at)) !!}</span></div>
                                                                                                                <div class="fake-class"><span class="data-details-title">Transaction Status</span>
                                                                                                                        @if($data->status == "Pending")
                                                                                                                        <span class="badge badge-warning ucap">Pending</span>
                                                                                                                        @elseif($data->status == "Paid")
                                                                                                                        <span class="badge badge-info ucap">Awaiting</span>
                                                                                                                        @elseif($data->status == "Confirmed")
                                                                                                                        <span class="badge badge-success ucap">Approved</span>
                                                                                                                        @elseif($data->status == "Declined")
                                                                                                                        <span class="badge badge-danger ucap">Declined</span>
                                                                                                                        @elseif($data->status == "Cancelled")
                                                                                                                        <span class="badge badge-danger ucap">Cancelled</span>
                                                                                                                        @endif
                                                                                                                </div>
                                                                                                                <div class="fake-class"><span class="data-details-title">Transaction Number</span><span class="data-details-info">{{$data->trx}}</span></div>
                                                                                                        </div>
                                                                                                        <div class="gaps-3x"></div>
                                                                                                        <h6 class="card-sub-title">Transaction Info</h6>
                                                                                                        <ul class="data-details-list">
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Transaction Type</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <strong>{{$data->type}}</strong>
                                                                                                                        </div>
                                                                                                                </li><!-- li -->
                                                                                                                @if($data->type == "Deposit")
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Payment Method</div>
                                                                                                                        <div class="data-details-des"><strong>
                                                                                                                                        @if($data->payment_method_id == "Bank Transfer")
                                                                                                                                        <span>{{isset($data->method->name) ? $data->method->name : 'N/A'}}</span>
                                                                                                                                        @endif
                                                                                                                                        @if($data->payment_method_id == "Online Payment")
                                                                                                                                        <span>{{isset($data->gateway_id) ? $data->gateway->name : 'N/A'}}</span>
                                                                                                                                        @endif
                                                                                                                                        <small>- {{isset($data->payment_method_id) ? $data->payment_method_id : 'N/A'}}</small></strong>
                                                                                                                        </div>
                                                                                                                </li>

                                                                                                                @if($data->status == "Paid")
                                                                                                                @if(isset($data->trans_prove_num))
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Payment Number</div>
                                                                                                                        <div class="data-details-des"><span>{{$data->trans_prove_num}}</span> <span></span></div>
                                                                                                                </li>
                                                                                                                @endif
                                                                                                                @if(isset($data->image))
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Payment Prove</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <a href="{{asset('transaction_proves/'.$data->image)}}" download="">
                                                                                                                                        <img class="img-fluid" src="{{asset('transaction_proves/'.$data->image)}}" style="width:50px">
                                                                                                                                </a>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @endif


                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Amount</div>
                                                                                                                        <div class="data-details-des"><b style="color:#21a184">{{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</b></div>
                                                                                                                </li>

                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Charge</div>
                                                                                                                        <div class="data-details-des"><b style="color:#21a184">{{ $basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</b></div>
                                                                                                                </li>

                                                                                                                @if($data->type == "Deposit" || $data->type == "Buy")
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Amount Paid</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <span>
                                                                                                                                        <b style="color:#21a184">
                                                                                                                                                {{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}
                                                                                                                                        </b>
                                                                                                                                </span>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                @endif
                                                                                                        </ul><!-- .data-details -->



                                                                                                        @if($data->payment_method_id == "Bank Transfer")

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
                                                                                                        @endif

                                                                                                        @if($data->type == "Withdraw")

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
                                                                                                        @endif

                                                                                                        <div class="gaps-3x"></div>
                                                                                                        @if(isset($data->currency))
                                                                                                        <h6 class="card-sub-title">Currency Details</h6>
                                                                                                        <ul class="data-details-list">
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Currency Name</div>
                                                                                                                        <div class="data-details-des"><strong>{{$data->currency->name}}</strong></div>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Rate</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <span>
                                                                                                                                        <strong>
                                                                                                                                                <b style="color:#21a184">
                                                                                                                                                        {{ $basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}} {{$basic->currency}}
                                                                                                                                                </b>
                                                                                                                                        </strong>
                                                                                                                                </span>
                                                                                                                                <span>
                                                                                                                                        <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="1 USD = {{ $basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}"></em>
                                                                                                                                        1 USD = {{ $basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}
                                                                                                                                </span>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Amount In Dollars</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <strong>
                                                                                                                                        <b style="color:#21a184">
                                                                                                                                                ${{number_format($data->currency_amount_usd, $basic->decimal)}} USD
                                                                                                                                        </b>
                                                                                                                                </strong>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Amount in {{$basic->currency}}</div>
                                                                                                                        <div class="data-details-des">
                                                                                                                                <strong>
                                                                                                                                        <b style="color:#21a184">
                                                                                                                                                {{ $basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}
                                                                                                                                        </b>
                                                                                                                                </strong>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                @if($data->type == "Buy")
                                                                                                                @if(isset($data->wallet))
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">{{$data->currency->name}} Wallet</div>
                                                                                                                        <div class="data-details-des"><span>{{$data->wallet}}</span></div>
                                                                                                                </li>
                                                                                                                @endif
                                                                                                                @endif

                                                                                                                @if($data->type == 1)
                                                                                                                <li>
                                                                                                                        <div class="data-details-head">Wallet Address</div>
                                                                                                                        <div class="data-details-des"><span><strong>{{$data->wallet}}</strong></span></div>
                                                                                                                </li>
                                                                                                                @endif

                                                                                                                <!-- li -->
                                                                                                        </ul><!-- .data-details -->
                                                                                                        @endif
                                                                                                </div><!-- .card -->
                                                                                        </div>
                                                                                </div><!-- .modal-content -->
                                                                        </div><!-- .modal-dialog -->
                                                                </div><!-- Modal End -->
                                                                @endforeach
                                                                @else
                                                                No Transaction Record Forund Yet
                                                                @endif

                                                                <!-- .data-item -->
                                                        </tbody>
                                                </table><!-- .table -->
                                        </div>
                                </div>
                        </div>




                        <div class="col-xl-4 col-lg-5">
                                <div class="token-sales card card-full-height">
                                        <div class="card-innr">
                                                <div class="card-head">
                                                        <h4 class="card-title">Currency/Coin Calculator</h4>
                                                </div><iframe src="https://widget.coinlib.io/widget?type=converter&theme=light" style="width:100%" height="310px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe>
                                        </div>
                                </div>
                        </div>



                </div><!-- .container -->
        </div><!-- .page-content -->
</div>
@endsection
@section('js')