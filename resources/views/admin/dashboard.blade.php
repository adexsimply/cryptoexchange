@extends('include.admindashboard')

@section('body')
<div class="page-content">
    <div class="container">
        <div class="row">


            <div class="col-lg-4">
                <div class="bg-primary token-statistics card card-token height-auto">
                    <div class="card-innr">
                        <div class="token-balance token-balance-with-icon">
                            <div class="token-balance-icon"><em class="h2 color-white ti ti-user"></em></div>
                            <div class="token-balance-text">
                                <h6 class="card-sub-title">Total Users</h6><span class="lead">{{$totalusers}} <span>Users</span></span>
                            </div>
                        </div>
                        <div class="token-balance token-balance-s2">
                            <h6 class="card-sub-title">Summary</h6>
                            <ul class="token-balance-list">
                                <li class="token-balance-sub"><span class="lead">{{$activeusers}} User(s) </span><span class="sub">Active Users</span></li>
                                <li class="token-balance-sub"><span class="lead">{{$verified}} User(s)</span><span class="sub">Verified Users</span></li>
                                <li class="token-balance-sub"><span class="lead">{{ $banusers}} User(s)</span><span class="sub">Inactive Users</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-primary token-statistics card card-token height-auto">
                    <div class="card-innr">
                        <div class="token-balance token-balance-with-icon">
                            <div class="token-balance-icon"><em class="h2 color-white ti ti-user"></em></div>
                            <div class="token-balance-text">
                                <h6 class="card-sub-title">Deposit</h6><span class="lead">{{$basic->currency_sym}}{{number_format($ppro, $basic->decimal)}}</span>
                            </div>
                        </div>
                        <div class="token-balance token-balance-s2">
                            <h6 class="card-sub-title">Summary</h6>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($dpend, $basic->decimal)}} </span><span class="sub">Pending</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($dpaid, $basic->decimal)}} </span><span class="sub">Paid Not Confirmed</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($dcan, $basic->decimal)}} </span><span class="sub">Cancelled</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($ddec, $basic->decimal)}} </span><span class="sub">Declined</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-primary token-statistics card card-token height-auto">
                    <div class="card-innr">
                        <div class="token-balance token-balance-with-icon">
                            <div class="token-balance-icon"><em class="h2 color-white ti ti-user"></em></div>
                            <div class="token-balance-text">
                                <h6 class="card-sub-title">Withdraw</h6><span class="lead">{{$basic->currency_sym}}{{number_format($ppro, $basic->decimal)}}</span>
                            </div>
                        </div>
                        <div class="token-balance token-balance-s2">
                            <h6 class="card-sub-title">Summary</h6>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($wpend, $basic->decimal)}} </span><span class="sub">Pending</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($wpaid, $basic->decimal)}} </span><span class="sub">Paid Not Confirmed</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($wcan, $basic->decimal)}} </span><span class="sub">Cancelled</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($wdec, $basic->decimal)}} </span><span class="sub">Declined</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="bg-secondary token-statistics card card-token height-auto">
                    <div class="card-innr">
                        <div class="token-balance token-balance-with-icon">
                            <div class="token-balance-icon"><em class="h2 color-white ti ti-import"></em></div>
                            <div class="token-balance-text">
                                <h6 class="card-sub-title">Purchased Cryptocurrency</h6><span class="lead">{{$basic->currency_sym}}{{number_format($ppro, $basic->decimal)}}</span>
                            </div>
                        </div>
                        <div class="token-balance token-balance-s2">
                            <h6 class="card-sub-title">Summary</h6>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($ppend, $basic->decimal)}} </span><span class="sub">Pending</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($ppaid, $basic->decimal)}} </span><span class="sub">Paid Not Confirmed</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($pcan, $basic->decimal)}} </span><span class="sub">Cancelled</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($pdec, $basic->decimal)}} </span><span class="sub">Declined</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-lg-6">
                <div class="bg-secondary token-statistics card card-token height-auto">
                    <div class="card-innr">
                        <div class="token-balance token-balance-with-icon">
                            <div class="token-balance-icon"><em class="h2 color-white ti ti-export"></em></div>
                            <div class="token-balance-text">
                                <h6 class="card-sub-title">Sold Cryptocurrency</h6><span class="lead">{{$basic->currency_sym}}{{number_format($spro, $basic->decimal)}}</span>
                            </div>
                        </div>
                        <div class="token-balance token-balance-s2">
                            <h6 class="card-sub-title">Summary</h6>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($spend, $basic->decimal)}} </span><span class="sub">Pending</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($spaid, $basic->decimal)}} </span><span class="sub">Paid Not Confirmed</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($scan, $basic->decimal)}} </span><span class="sub">Cancelled</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="lead" style="font-size: 20px;">{{$basic->currency_sym}}{{number_format($sdec, $basic->decimal)}} </span><span class="sub">Declined</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col -->

            <!-- .col -->
            <div class="col-lg-6">
                <div class="card card-full-height">
                    <div class="card-innr">
                        <div class="card-head has-aside pb-0">
                            <h4 class="card-title">Recent Users</h4>
                        </div>
                        <table class="data-table user-list">
                            <tbody>

                                @foreach($users as $k=>$data)
                                <tr class="data-item">
                                    <td class="data-col dt-user">
                                        <div class="user-block">
                                            <div class="user-photo"> @if( file_exists($data->image))
                                                <img src=" {{url($data->image)}} " width="100" alt="Profile Pic">
                                                @else

                                                <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">
                                                @endif
                                            </div>
                                            <div class="user-info"><span class="lead user-name">{{$data->username}}</span><span class="sub user-id">{{$data->email}}</span></div>
                                        </div>
                                    </td>
                                    <td class="data-col dt-join text-right"><span class="sub join-time">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</span></td>
                                </tr>
                                @endforeach

                                <!-- .data-item -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-6">
                <div class="card card-timeline card-full-height">
                    <div class="card-innr">
                        <div class="card-head has-aside">
                            <h4 class="card-title">Requests & Messages</h4>
                        </div>


                        <div class="timeline-wrap" id="timeline-notify">
                            <div data-simplebar="init">
                                <div class="timeline-innr">
                                    <div class="timeline">
                                        <div class="timeline-line"></div>

                                        @if(count($inbox) > 0)
                                        @foreach($inbox as $k=>$data)
                                        <div class="timeline-item secondary">
                                            <div class="timeline-time">{!! date('d/M/y', strtotime($data->created_at)) !!}</div>
                                            <div class="timeline-content"><a href="{{route('ticket.view',$data->id)}}" class="timeline-content-url">{{$data->title}}</a><span class="timeline-content-info">{{App\User::whereId($data->user_id)->first()->username}}</span></div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="timeline-item secondary">
                                            <div class="timeline-time">Today</div>
                                            <div class="timeline-content"><a href="#" class="timeline-content-url">Message Inbox Is Empty As No User Has Made Any Request Or Complaints So Far. Keep up the good management task</a><span class="timeline-content-info">Empty</span></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-load"><a href="" class="link load-timeline" data-target="timeline-notify" data-show="2">Load More</a></div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <!-- .container -->
        </div><!-- .page-content -->

        @endsection

        @section('script')


        @stop