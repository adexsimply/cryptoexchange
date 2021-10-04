@extends('include.admindashboard')

@section('body')

<script>
function goBack() {
  window.history.back()
}
</script>


<div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Request Date</span><span class="data-details-info">{{$data->created_at}}</span></div><div class="fake-class"><span class="data-details-title">Request Status</span>


 @if($data->status == 1)
            <span  class="badge  badge-pill  badge-success "> Approved </span>
                                        @elseif($data->status == 0)
            <span class="badge  badge-pill  badge-warning ">Pending </span>
                                        @elseif($data->status == -2)
            <span class="badge  badge-pill  badge-danger ">Refund </span>
                                        @endif



</div><div class="fake-class"><span class="data-details-title">Username</span><span class="data-details-info">  <strong>{{App\User::whereId($data->user_id)->first()->username }}</strong> ({{$data->user->email}})</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Transaction Type</div><div class="data-details-des"><strong>Transfer</strong></div></li><!-- li --><li><div class="data-details-head">Receiver</div><div class="data-details-des"><strong>{{$data->send_details}} <small>- Payment Beneficiary</small></strong></div></li><!-- li --><li><div class="data-details-head">Amount</div><div class="data-details-des"><strong>{!! number_format($data->amount, $basic->decimal)  !!} {{$basic->currency}}</strong></div></li><!-- li -->  <!-- li --><li><div class="data-details-head">TRX ID</div><div class="data-details-des">{{$data->transaction_id}}</div></li><!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div> <!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
