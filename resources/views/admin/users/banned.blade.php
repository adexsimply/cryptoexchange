@extends('include.admindashboard')

@section('body')
   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">User List</h4></div><table class="data-table dt-init user-list"><thead><tr class="data-item data-head"><th class="data-col dt-user">User</th><th class="data-col dt-email">Email</th><th class="data-col dt-token">Balance</th><th class="data-col dt-verify">Verification Status</th><th class="data-col dt-login">Registered Date</th><th class="data-col dt-status"><div class="dt-status-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

  @foreach($users as $user)
<tr class="data-item"><td class="data-col dt-user"><span class="lead user-name">{{$user->fname}} {{$user->lname}}</span><span class="sub user-id">{{$user->username}}</span></td><td class="data-col dt-email"><span class="sub sub-s2 sub-email">{{$user->email}}</span></td><td class="data-col dt-token"><span class="lead lead-btoken">{{$basic->currency}}{{number_format($user->balance, $basic->decimal)}}</span></td><td class="data-col dt-verify"><ul class="data-vr-list"><li>

@if($user->email_verify == 1)
<div class="data-state data-state-sm data-state-approved"></div>
@else
<div class="data-state data-state-sm data-state-pending"></div>
@endif
 Email</li><li>

 @if($user->verified == 1)
<div class="data-state data-state-sm data-state-approved"></div>
@else
<div class="data-state data-state-sm data-state-pending"></div>
@endif KYC</li></ul></td><td class="data-col dt-login"><span class="sub sub-s2 sub-time">{{$user->created_at}}</span></td><td class="data-col dt-status">
@if($user->status == 1)
<span class="dt-status-md badge badge-outline badge-success badge-md">Active</span>
@else
<span class="dt-status-md badge badge-outline badge-danger badge-md">Inactive</span>
@endif

<span class="dt-status-sm badge badge-sq badge-outline badge-success badge-md">A</span></td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('user.single', $user->id)}}"><em class="ti ti-eye"></em> View Details</a></li>

@if($user->status < 1)
<li><a href="{{route('user.activate', $user->id)}}"><em class="ti ti-check"></em> Activate</a></li>
<li><a href="{{route('user.delete', $user->id)}}"><em class="ti ti-trash"></em> Delete</a></li>
@else
<li><a href="{{route('user.block', $user->id)}}"><em class="ti ti-na"></em> Suspend</a></li>
@endif

 </ul></div></div></td></tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
