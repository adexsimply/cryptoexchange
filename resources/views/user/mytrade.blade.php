@extends('include.userdashboard')

@section('content')


<div class="fake-class">

  <span class="lead tnx-id">{{$data->trx}}</span><span class="sub sub-date"> {!! date(' d/M/Y ', strtotime($data->created_at)) !!} </span>
</div>
</div>
</td>
<td class="data-col dt-token"><span class="lead token-amount">{{number_format($data->amount, $basic->decimal)}}</span><span class="sub sub-symbol">USD</span></td>
<td class="data-col dt-amount"><span class="lead amount-pay">{{number_format($data->main_amo, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}} <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="1 USD = {{$basic->currency}}{{$data->rate}} "></em></span></td>
<td class="data-col dt-usd-amount"><span class="lead amount-pay">{{$data->rate}}</span><span class="sub sub-symbol">{{$basic->currency}} </span></td>
<td class="data-col dt-type">

  @if($data->status == 0)
  <span class="dt-type-md badge badge-outline badge-secondary badge-md">Unprocessed</span>
  @elseif($data->status == 1)
  <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
  @elseif($data->status == 2)
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
            <div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{$data->created_at}}</span></div>
            <div class="fake-class"><span class="data-details-title">Tranx Status</span>@if($data->status == 0)
              <span class="dt-type-md badge badge-outline badge-secondary badge-md">Unprocessed</span>
              @elseif($data->status == 1)
              <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
              @elseif($data->status == 2)
              <span class="dt-type-md badge badge-outline badge-success badge-md">Successful</span>
              @else
              <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
              @endif

            </div>
            <div class="fake-class"><span class="data-details-title">Tranx ID Number</span><span class="data-details-info">00BUY{{$data->id}}</span></div>
          </div>
          <div class="gaps-3x"></div>
          <h6 class="card-sub-title">Transaction Info</h6>
          <ul class="data-details-list">
            <li>
              <div class="data-details-head">Transaction Type</div>
              <div class="data-details-des"><strong>Purchase</strong></div>
            </li><!-- li -->
            <li>
              <div class="data-details-head">Payment Receiver</div>
              <div class="data-details-des"><strong>{{$data->wallet}} </strong></div>
            </li><!-- li -->
            <li>
              <div class="data-details-head">Expected Amount</div>
              <div class="data-details-des"><strong>USD{{$data->amount}}</strong></div>
            </li><!-- li -->
            <li>
              <div class="data-details-head">Tx Hash</div>
              <div class="data-details-des"><span>{{$data->trx}}</span> <span></span></div>
            </li><!-- li -->
            <li>
              <div class="data-details-head">Cryptocurrency </div>
              <div class="data-details-des"><span>{{$data->currency->name}}</span> <span></span></div>
            </li><!-- li -->
            <li>
              <div class="data-details-head">Payment Method</div>
              <div class="data-details-des">{{App\PaymentMethod::whereId($data->method)->first()->name}}</div>
            </li>
            <li>
              <div class="data-details-head">Bank Account</div>
              <div class="data-details-des">{{App\Bank::whereId($data->bank)->first()->name}}</div>
            </li>
            <li>
              <div class="data-details-head">Depositor</div>
              <div class="data-details-des">{{$data->depositor}}</div>
            </li>
            <li>
              <div class="data-details-head">Payment Number</div>
              <div class="data-details-des">{{$data->tnum}}</div>
            </li>
            <li><br>
              <div class="data-details-head">Payment Screenshot</div>
              <div class="data-doc-item data-doc-item-lg">
                <div class="data-doc-image"><img src="{{asset('uploads/payments/'.$data->image)}}" alt="passport"></div>
                <ul class="data-doc-actions">
                  <li><a href="{{asset('uploads/payments/'.$data->image)}}" download><em class="ti ti-import"></em></a></li>
                </ul>
              </div>
            </li>




            <!-- li -->
          </ul>
        </div><!-- .card -->
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog -->
</div><!-- Modal End -->

@endforeach
<!-- .data-item -->
</tbody>
</table>





</div>

<div class="tab-pane fade" id="tab-item-5">
  <h4>My Sales History</h4>

  <table class="data-table dt-init user-tnx">
    <thead>
      <tr class="data-item data-head">
        <th class="data-col dt-tnxno">Tranx NO</th>
        <th class="data-col dt-token">Amount</th>
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

            @if($data->status == 0)
            <div class="data-state data-state-pending">
              <span class="d-none">Pending</span>
            </div>

            @elseif($data->status == 1)
            <div class="data-state data-state-progress">
              <span class="d-none">Progress</span>
            </div>

            @elseif($data->status == 2)
            <div class="data-state data-state-approved">
              <span class="d-none">Approved</span>
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
        <td class="data-col dt-token"><span class="lead token-amount">{{number_format($data->amount, $basic->decimal)}}</span><span class="sub sub-symbol">USD</span></td>
        <td class="data-col dt-amount"><span class="lead amount-pay">{{number_format($data->main_amo, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}} <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="1 USD = {{$basic->currency}}{{$data->rate}} "></em></span></td>
        <td class="data-col dt-usd-amount"><span class="lead amount-pay">{{$data->rate}}</span><span class="sub sub-symbol">{{$basic->currency}} </span></td>
        <td class="data-col dt-type">

          @if($data->status == 0)
          <span class="dt-type-md badge badge-outline badge-secondary badge-md">Unprocessed</span>
          @elseif($data->status == 1)
          <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
          @elseif($data->status == 2)
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
                  <div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{$data->created_at}}</span></div>
                  <div class="fake-class"><span class="data-details-title">Tranx Status</span>@if($data->status == 0)
                    <span class="dt-type-md badge badge-outline badge-secondary badge-md">Unprocessed</span>
                    @elseif($data->status == 1)
                    <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
                    @elseif($data->status == 2)
                    <span class="dt-type-md badge badge-outline badge-success badge-md">Successful</span>
                    @else
                    <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span>
                    @endif

                  </div>
                  <div class="fake-class"><span class="data-details-title">Tranx ID Number</span><span class="data-details-info">{{$data->trx}}</span></div>
                </div>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">Transaction Info</h6>
                <ul class="data-details-list">
                  <li>
                    <div class="data-details-head">Transaction Type</div>
                    <div class="data-details-des"><strong>Sale</strong></div>
                  </li><!-- li -->
                  <li>
                    <div class="data-details-head">Amount</div>
                    <div class="data-details-des"><strong>USD{{$data->amount}} <small></small></strong></div>
                  </li><!-- li -->
                  <li>
                    <div class="data-details-head">Currency</div>
                    <div class="data-details-des"><strong>{{$data->get_amount}}{{$data->currency->symbol}}</strong></div>
                  </li><!-- li -->
                  <li>
                    <div class="data-details-head">Tx Hash</div>
                    <div class="data-details-des"><span>{{$data->trx}}</span> <span></span></div>
                  </li><!-- li -->
                  <li>
                    <div class="data-details-head">Bank Name </div>
                    <div class="data-details-des"><span>{{$data->bankname}}</span> <span></span></div>
                  </li><!-- li -->
                  <li>
                    <div class="data-details-head">Account Number</div>
                    <div class="data-details-des">{{$data->accountnumber}}</div>
                  </li>
                  <li>
                    <div class="data-details-head">Account Name</div>
                    <div class="data-details-des">{{$data->accountname}}</div>
                  </li><!-- li -->

                  <li>
                    <div class="data-details-head">Payment Number</div>
                    <div class="data-details-des"><span><strong>{{$data->tnum}}</strong></span></div>
                  </li>

                  <li><br>
                    <div class="data-details-head">Payment Screenshot</div>
                    <div class="data-doc-item data-doc-item-lg">
                      <div class="data-doc-image"><img src="{{asset('uploads/payments/'.$data->image)}}" alt="passport"></div>
                      <ul class="data-doc-actions">
                        <li><a href="{{asset('uploads/payments/'.$data->image)}}" download><em class="ti ti-import"></em></a></li>
                      </ul>
                    </div>
                  </li>



                </ul>
              </div><!-- .card -->
            </div>
          </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
      </div><!-- Modal End -->

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