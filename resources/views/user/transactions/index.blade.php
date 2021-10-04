@extends('include.userdashboard')

@section('content')

<div class="page-content">
  <div class="container">
    <div class="content-area card">
      <div class="card-innr">


        <div class="card-head">
          <h6 class="card-title">My Trade Log</h6>
        </div>
        <div class="gaps-1x"></div>
        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-item-4">Purchase</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-item-5">Sales</a></li>
        </ul>
        <div class="tab-content">

          <div class="tab-pane fade active show" id="tab-item-4">
            <h4>My Purchase History</h4>

            <table class="data-table dt-init user-tnx table-responsive">
              <thead>
                <tr class="data-item data-head">
                  <th class="data-col dt-tnxno">Tranx NO</th>
                  <th class="data-col dt-usd-amount">Coin</th>
                  <th class="data-col dt-token">Amount IN {{$basic->currency}}</th>
                  <th class="data-col dt-token">Amount IN USD</th>
                  <th class="data-col dt-amount">Purchased Rate</th>
                  <th class="data-col dt-type">
                    <div class="dt-type-text">Status</div>
                  </th>
                  <th class="data-col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($buy as $data)
                <tr class="data-item">
                  <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">

                      @if($data->status == "Pending")
                      <div class="data-state data-state-pending">
                        <span class="d-none">Pending</span>
                      </div>
                      @elseif($data->status == "Confirmed")
                      <div class="data-state data-state-approved">
                        <span class="d-none">Approved</span>
                      </div>
                      @elseif($data->status == "Declined")
                      <div class="data-state data-state-canceled">
                        <span class="d-none">Declined</span>
                      </div>

                      @else
                      <div class="data-state data-state-canceled">
                        <span class="d-none">Declined</span>
                      </div>
                      @endif
                      <div class="fake-class">
                        <span class="lead tnx-id">{{$data->trx}}</span><span class="sub sub-date"> {!! date(' d/M/Y ', strtotime($data->created_at)) !!} </span>
                      </div>
                    </div>
                  </td>
                  <td class="data-col dt-usd-amount"><span class="lead amount-pay">{{$data->currency->name}}</span><span class="sub sub-symbol">{{$data->currency->symbol}} </span></td>
                  <td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></td>
                  <td class="data-col dt-token"><span class="lead token-amount">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></td>
                  <td class="data-col dt-amount"><span class="lead amount-pay">{{$basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}</span></td>
                  <td class="data-col dt-type">

                    @if($data->status == "Pending")
                    <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
                    @elseif($data->status == "Declined")
                    <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                    @elseif($data->status == "Confirmed")
                    <span class="dt-type-md badge badge-outline badge-success badge-md">Successful</span>
                    @else
                    <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                    @endif

                    <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">P</span>
                  </td>
                  <td class="data-col text-right"><a href="#" data-toggle="modal" data-target="#transaction{{$data->id}}details" class="btn btn-light-alt btn-xs btn-icon"><em class="ti ti-eye"></em></a></td>
                </tr>
                <!-- Modal Large -->
                <div class="modal fade" id="transaction{{$data->id}}details" tabindex="-1">
                  <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                    <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                      <div class="popup-body popup-body-lg">
                        <div class="content-area">
                          <div class="card-head d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Transaction Details</h4>
                          </div>
                          <div class="gaps-1-5x"></div>
                          <div class="data-details d-md-flex">
                            <div class="fake-class"><span class="data-details-title">Transaction Date</span><span class="data-details-info">{{$data->created_at}}</span></div>
                            <div class="fake-class"><span class="data-details-title">Transaction Status</span>

                              @if($data->status == "Pending")
                              <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
                              @elseif($data->status == "Declined")
                              <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                              @elseif($data->status == "Confirmed")
                              <span class="dt-type-md badge badge-outline badge-success badge-md">Successful</span>
                              @else
                              <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                              @endif

                            </div>
                            <div class="fake-class"><span class="data-details-title">Transaction Number</span><span class="data-details-info">{{$data->trx}}</span></div>
                          </div>
                          <div class="gaps-3x"></div>
                          <h6 class="card-sub-title">Transaction Info</h6>
                          <ul class="data-details-list">
                            <li>
                              <div class="data-details-head">Transaction Type</div>
                              <div class="data-details-des"><strong>Purchase</strong></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Transaction Number</div>
                              <div class="data-details-des"><strong>{{$data->trx}}</strong></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Coin Purchased</div>
                              <div class="data-details-des"><span>{{$data->currency->name}} ({{$data->currency->symbol}})</span></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Coin Purchased Rate</div>
                              <div class="data-details-des"><span style="color: #21a184;">{{$basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}</span></div>
                            </li>
                            <li>
                              <div class="data-details-head">Amount USD</div>
                              <div class="data-details-des"><span style="color: #21a184;">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></div>
                            </li>
                            <li>
                              <div class="data-details-head">Amount {{$basic->currency}}</div>
                              <div class="data-details-des"><span style="color: #21a184;">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div>
                            </li>
                            <li>
                              <div class="data-details-head">{{$data->currency->name}} Wallet</div>
                              <div class="data-details-des"><span>{{$data->wallet}}</span></div>
                            </li>
                            @if($data->image)
                            <li>
                              <div class="data-details-head">Purchase Proof</div>
                              <div class="data-details-des"><a href="{{asset('assets/purchase_prove/'.$data->image)}}" download=""><img src="{{asset('assets/purchase_prove/'.$data->image)}}" alt="..." class="img-thumbnail" style="width: 100px;"></a></div>
                            </li>
                            @endif
                          </ul>
                        </div><!-- .card -->
                      </div>
                    </div><!-- .modal-content -->
                  </div><!-- .modal-dialog -->
                </div>
                <!-- Modal End -->
                @endforeach

                <!-- .data-item -->
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="tab-item-5">
            <h4>My Sales History</h4>
            <table class="data-table dt-init user-tnx table-responsive">
              <thead>
                <tr class="data-item data-head">
                  <th class="data-col dt-tnxno">Tranx NO</th>
                  <th class="data-col dt-token">Amount in {{$basic->currency}}</th>
                  <th class="data-col dt-amount">Rate</th>
                  <th class="data-col dt-usd-amount">Price</th>
                  <th class="data-col dt-type">
                    <div class="dt-type-text">Status</div>
                  </th>
                  <th class="data-col"></th>
                </tr>
              </thead>
              <tbody>

                @foreach($sell as $data)
                <tr class="data-item">
                  <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">

                      @if($data->status == "Paid")
                      <div class="data-state data-state-progress">
                        <span class="d-none">Paid</span>
                      </div>
                      @elseif($data->status == "Confirmed")
                      <div class="data-state data-state-approved">
                        <span class="d-none">Approved</span>
                      </div>
                      @elseif($data->status == "Pending")
                      <div class="data-state data-state-pending">
                        <span class="d-none">Pending</span>
                      </div>
                      @elseif($data->status == "Declined")
                      <div class="data-state data-state-canceled">
                        <span class="d-none">Declined</span>
                      </div>
                      @elseif($data->status == "Cancelled")
                      <div class="data-state data-state-canceled">
                        <span class="d-none">Cancelled</span>
                      </div>
                      @endif
                      <div class="fake-class">
                        <span class="lead tnx-id">{{$data->trx}}</span><span class="sub sub-date"> {!! date(' d/M/Y ', strtotime($data->created_at)) !!} </span>
                      </div>
                    </div>
                  </td>
                  <td class="data-col dt-usd-amount"><span class="lead amount-pay">{{$data->currency->name}}</span><span class="sub sub-symbol">{{$data->currency->symbol}} </span></td>
                  <td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></td>
                  <td class="data-col dt-token"><span class="lead token-amount">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></td>
                  <td class="data-col dt-amount"><span class="lead amount-pay">{{$basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}</span></td>
                  <td class="data-col dt-type">

                    @if($data->status == "Pending")
                    <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
                    &nbsp;&nbsp;
                    <a href="{{ route('sell_get', $data->trx) }}" class="btn btn-auto btn-primary btn-xs"><span>Sell <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-wallet"></em></a>
                    @elseif($data->status == "Declined")
                    <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                    @elseif($data->status == "Cancelled")
                    <span class="dt-type-md badge badge-outline badge-danger badge-md">Cancelled</span>
                    @elseif($data->status == "Confirmed")
                    <span class="dt-type-md badge badge-outline badge-success badge-md">Successful</span>
                    @elseif($data->status == "Paid")
                    <span class="dt-type-md badge badge-outline badge-warning badge-md">Paid</span>
                    &nbsp;&nbsp
                    <span class="dt-type-md badge badge-outline badge-success badge-sm"><i class="fa fa-spinner fa-spin"></i>&nbsp;Awaiting Approval</span>
                    @endif

                    <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">P</span>
                  </td>
                  <td class="data-col text-right"><a href="#" data-toggle="modal" data-target="#transaction{{$data->id}}details" class="btn btn-light-alt btn-xs btn-icon"><em class="ti ti-eye"></em></a></td>
                </tr>

                <!-- Modal Large -->
                <div class="modal fade" id="transaction{{$data->id}}details" tabindex="-1">
                  <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                    <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                      <div class="popup-body popup-body-lg">
                        <div class="content-area">
                          <div class="card-head d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Transaction Details</h4>
                          </div>
                          <div class="gaps-1-5x"></div>
                          <div class="data-details d-md-flex">
                            <div class="fake-class"><span class="data-details-title">Transaction Date</span><span class="data-details-info">{{$data->created_at}}</span></div>
                            <div class="fake-class"><span class="data-details-title">Transaction Status</span>

                              @if($data->status == "Pending")
                              <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
                              @elseif($data->status == "Declined")
                              <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                              @elseif($data->status == "Paid")
                              <span class="dt-type-md badge badge-outline badge-process badge-md">Paid</span>
                              @elseif($data->status == "Confirmed")
                              <span class="dt-type-md badge badge-outline badge-success badge-md">Confirmed</span>
                              @else
                              <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                              @endif

                            </div>
                            <div class="fake-class"><span class="data-details-title">Transaction Number</span><span class="data-details-info">{{$data->trx}}</span></div>
                          </div>
                          <div class="gaps-3x"></div>
                          <h6 class="card-sub-title">Transaction Info</h6>
                          <ul class="data-details-list">
                            <li>
                              <div class="data-details-head">Transaction Type</div>
                              <div class="data-details-des"><strong>{{$data->type}}</strong></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Transaction Number</div>
                              <div class="data-details-des"><strong>{{$data->trx}}</strong></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Coin Purchased</div>
                              <div class="data-details-des"><span>{{$data->currency->name}} ({{$data->currency->symbol}})</span></div>
                            </li><!-- li -->
                            <li>
                              <div class="data-details-head">Coin Purchased Rate</div>
                              <div class="data-details-des"><span style="color: #21a184;">{{$basic->currency_sym}}{{number_format($data->currency_rate, $basic->decimal)}}</span></div>
                            </li>
                            <li>
                              <div class="data-details-head">Amount USD</div>
                              <div class="data-details-des"><span style="color: #21a184;">${{number_format($data->currency_amount_usd, $basic->decimal)}}</span></div>
                            </li>
                            <li>
                              <div class="data-details-head">Amount {{$basic->currency}}</div>
                              <div class="data-details-des"><span style="color: #21a184;">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></div>
                            </li>

                            @if($data->status == "Paid")
                            @if(isset($data->trans_prove_num))
                            <li>
                              <div class="data-details-head">Payment Transaction ID</div>
                              <div class="data-details-des"><span>{{$data->trans_prove_num}}</span> <span></span></div>
                            </li>
                            @endif
                            @if(isset($data->image))
                            <li>
                              <div class="data-details-head">Payment Proof</div>
                              <div class="data-details-des">
                                <a href="{{asset('transaction_proves/'.$data->image)}}" download="">
                                  <img class="img-fluid" src="{{asset('transaction_proves/'.$data->image)}}" style="width:50px">
                                </a>
                              </div>
                            </li>
                            @endif
                            @endif
                          </ul>
                        </div><!-- .card -->
                      </div>
                    </div><!-- .modal-content -->
                  </div><!-- .modal-dialog -->
                </div>
                @endforeach
                <!-- .data-item -->
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div><!-- .card -->
  </div><!-- .container -->
</div><!-- .page-content -->
@endsection