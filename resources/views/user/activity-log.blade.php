@extends('include.userdashboard')
@section('content')
  <div class="page-content"><div class="container"><div class="row"><div class="col-lg-12 main-content"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Activity</h4></div><div class="card-text"><p>Here is your recent activities. You can clear your log  or disable tracking option from security settings. </p></div><div class="gaps-1-5x"></div><table class="data-table dt-init activity-table" data-items="10"><thead><tr class="data-item data-head"><th class="data-col activity-time"><span>Date</span></th><th class="data-col activity-device"><span>Location</span></th><th class="data-col activity-browser"><span>Device</span></th><th class="data-col activity-ip"><span>IP</span></th></tr></thead><tbody>

@foreach($activity as $k=>$data)
  <tr class="data-item"><td class="data-col activity-time">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td><td class="data-col activity-device">{{$data->location}}</td><td class="data-col activity-browser">{{$data->details}}</td><td class="data-col activity-ip">{{$data->user_ip}}</td></tr>
@endforeach

  </tbody></table></div><!-- .card-innr --></div><!-- .card --></div></div></div><!-- .container --></div>
@stop
