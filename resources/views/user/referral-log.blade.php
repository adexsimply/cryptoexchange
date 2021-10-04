@extends('include.userdashboard')
@section('content')
  <div class="page-content"><div class="container"><div class="row"><div class="col-lg-12 main-content"><!-- Modal End -->

<div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Referral Log</h4></div><table class="data-table dt-init user-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Username</th><th class="data-col dt-token">Total TRX</th> <th class="data-col dt-account">Last Login</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($referral as $k=>$data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-progress"><span class="d-none">{{$data->username}}</span></div><div class="fake-class"><span class="lead tnx-id">{{$data->username}}</span><span class="sub sub-date">{{ date('d M Y',strtotime($data->created_at))}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency}}{{number_format(App\Trx::whereUser_id($data->id)->whereStatus(2)->sum('main_amo'), $basic->decimal)}}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td><td class="data-col dt-account"><span class="lead user-info">{{ date('s:m',strtotime($data->login_time))}}GNT</span><span class="sub sub-date">{{ date('d M Y',strtotime($data->login_time))}}</span></td><td class="data-col dt-type">

@if($data->status == 1)
<span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
@else
<span class="dt-type-md badge badge-outline badge-danger badge-md">Inactive</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">I</span>
@endif

</td><td class="data-col text-right"><a href="#" data-toggle="modal" data-target="#{{$data->username}}"  class="btn btn-light-alt btn-xs btn-icon"><em class="ti ti-eye"></em></a></td></tr><!-- .data-item -->




<!-- Modal Large --><div class="modal fade" id="{{$data->username}}" tabindex="-1"><div class="modal-dialog modal-dialog-lg modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body popup-body-lg"><div class="content-area"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">User Details</h4></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Registered Date</span><span class="data-details-info">{{ date('d M Y',strtotime($data->created_at))}}</span></div><div class="fake-class">

@if($data->status == 1)
<span class="data-details-title">Account Status</span><span class="badge badge-success ucap">Aactive</span>
@else
<span class="data-details-title">Account Status</span><span class="badge badge-danger ucap">Inactive</span>
@endif
</div><div class="fake-class"><span class="data-details-title">Last Account Update </span><span class="data-details-info">By <strong>User</strong> {{ date('d M Y',strtotime($data->updated_at))}}</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Referral Details</h6><ul class="data-details-list"><li><div class="data-details-head">First Name</div><div class="data-details-des"><strong>{{$data->fname}}</strong></div></li><!-- li --><li><div class="data-details-head">Last Name</div><div class="data-details-des"><strong>{{$data->lname}} <small>- {{$data->username}}</small></strong></div></li><!-- li --><li><div class="data-details-head">Total Buy</div><div class="data-details-des"><strong>{{$basic->currency}}{{number_format(App\Trx::whereUser_id($data->id)->whereType(1)->whereStatus(2)->sum('main_amo'), $basic->decimal)}}</strong></div></li>

<li><div class="data-details-head">Total Sell</div><div class="data-details-des"><strong>{{$basic->currency}}{{number_format(App\Trx::whereUser_id($data->id)->whereType(0)->whereStatus(2)->sum('main_amo'), $basic->decimal)}}</strong></div></li>



<!-- li --><li><div class="data-details-head">Email</div><div class="data-details-des"><span>{{$data->email}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Phone Number</div><div class="data-details-des"><span>{{$data->phone}}</span> <span></span></div></li><!-- li --><!-- .card --></div></div><!-- .modal-content -->
@endforeach

</tbody></table></div><!-- .card-innr -->
<div class="content-area card"><div class="card-innr"><div class="card-head"><h5 class="card-title card-title-md">Invite your friends and family to {{$gnl->sitename}} and receive free cryptos and fund</h5></div><div class="card-text"><p>Each member have a unique {{$basic->sitename}} referral link to share with friends and family and receive a <strong>bonus of {{$basic->currency_sym}}{{number_format($basic->ref, $basic->decimal)}}</strong> when they verify their account. If any one sign-up with your link, he or she will be added to your referral program. Your referral link may be used to invite more users.</p></div><div class="referral-form"><div class="d-flex justify-content-between align-items-center"><h5 class="mb-0 font-bold">Referral URL</h5><a href="#" class="link link-primary link-ucap">See Your referral</a></div><div class="copy-wrap mgb-1-5x mgt-1-5x"><span class="copy-feedback"></span><input type="text" class="copy-address" value="{{ route('refer.register',auth::user()->username) }}" disabled><button class="copy-trigger copy-clipboard" data-clipboard-text="{{ route('refer.register',auth::user()->username) }}"><em class="ti ti-files"></em></button></div><!-- .copy-wrap --></div><ul class="share-links"><li>Share with : </li> <li><a href="http://www.facebook.com/share.php?u={{ route('refer.register',auth::user()->username) }}&amp;title={{$gnl->title}} Referral Link"><em class="fab fa-facebook-f"></em></a></li><li><a href="whatsapp://send?text={{ route('refer.register',auth::user()->username) }}"><em class="fab fa-whatsapp"></em></a></li></ul></div></div></div>

</div><!-- .card --></div



><!-- .container --></div><!-- .page-content -->
@stop
