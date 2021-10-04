@extends('include.admindashboard')

@section('body')

<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">User's Message</h4></div><table class="data-table dt-init kyc-list"><thead><tr class="data-item data-head"><th class="data-col dt-user">Sender</th><th class="data-col dt-user">Subject</th> <th class="data-col dt-status">Status</th><th class="data-col"></th></tr></thead><tbody>

 @foreach($inbox as $k=>$data)
<tr class="data-item"><td class="data-col dt-user"><span class="lead user-name">{{$data->user->username}}</span><span class="sub user-id">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</span></td><td class="data-col dt-user"><span class="sub sub-s2 sub-dtype">{{$data->title}}</span></td> <td class="data-col dt-status">
@if($data->view == 0)
<span class="dt-status-md badge badge-outline badge-primary badge-md">New</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-primary badge-md">N</span>
@else
<span class="dt-status-md badge badge-outline badge-success badge-md">Checked</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-success badge-md">O</span>
@endif
</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('ticket.view',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li>
<li><a href="{{route('inbox-delete',$data->id)}}"><em class="ti ti-trash"></em> Delete</a></li></ul></div></div></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content --><

@endsection
