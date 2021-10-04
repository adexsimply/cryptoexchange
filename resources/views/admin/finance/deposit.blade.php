@extends('include.admindashboard')

@section('body')


<div class="page-content">
  <div class="container">
    <div class="content-area card">
      <div class="card-innr">
        <div class="card-head">
          <h4 class="card-title">{{$status}} Deposit Log</h4>
        </div>


        <table class="data-table dt-filter-init admin-tnx">
          <thead>
            <tr class="data-item data-head">
              <th class="data-col dt-tnxno">User</th>
              <th class="data-col dt-account">Payment Method</th>
              <th class="data-col dt-token">Amount</th>
              <!-- <th class="data-col dt-token">Charges</th> -->
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
                  <div class="data-state data-state-canceled"><span class="d-none">Declined</span></div>
                  @elseif( $data->status == "Cancelled" )
                  <div class="data-state data-state-canceled"><span class="d-none">Cancelled</span></div>
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
              <td class="data-col dt-amount"><span class="lead amount-pay"> {{isset($data->payment_method_id) ? $data->payment_method_id : 'N/A'}}</span>
                @if($data->payment_method_id == "Bank Transfer")
                <span>{{isset($data->method->name) ? $data->method->name : 'N/A'}}</span>
                @endif
                @if($data->payment_method_id == "Online Payment")
                <span>{{isset($data->gateway_id) ? $data->gateway->name : 'N/A'}}</span>
                @endif
              </td>
              <td class="data-col dt-token">
                <span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}}</span>
              </td>
              <!-- <td class="data-col dt-token">
                <span class="lead token-amount">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}}</span>
              </td> -->
              <td class="data-col dt-type">
                @if( $data->status == "Confirmed" )
                <span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
                @elseif( $data->status == "Declined" )
                <span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">P</span>
                @elseif( $data->status == "Pending" )
                <span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                @elseif( $data->status == "Paid" )
                <span class="dt-type-md badge badge-outline badge-warning badge-md">Paid</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                &nbsp;&nbsp
                <span class="dt-type-md badge badge-outline badge-success badge-sm"><i class="fa fa-spinner fa-spin"></i>&nbsp;Awaiting Approval</span>
                @elseif( $data->status == "Cancelled" )
                <span class="dt-type-md badge badge-outline badge-danger badge-md">Cancelled</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">C</span>
                @endif
              </td>

              <td class="data-col text-right">
                <div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                  <div class="toggle-class dropdown-content dropdown-content-top-left">
                    <ul class="dropdown-list">
                      <li><a href="{{route('deposit-info',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li>

                      @if($data->status == "Paid")
                      <li><a href="{{route('deposit_approve_admin',$data->id)}}"><em class="ti ti-check-box"></em> Approve</a></li>
                      <li><a href="{{route('deposit.reject',$data->id)}}"><em class="ti ti-na"></em> Decline</a></li>
                      @endif

                    </ul>
                  </div>
                </div>
              </td>
            </tr><!-- .data-item -->
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