@extends('include.userdashboard')

@section('content')

 <div class="page-content"><div class="container"><div class="row"><div class="col-lg-12 main-content"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Notifications</h4></div>

 <div class="timeline">

@foreach($notify as $k=>$data)
 <div class="timeline-line"></div><div class="timeline-item"><div class="timeline-time">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>

<div class="timeline-content"><span><b text-primary>{{$data->title}}</b></span><br><p text-danger>{{$data->details}}.</p>@if( file_exists(Auth::User()->image))
                        <img src="{{asset($data->image)}}" width="100"
                             alt="Notification Image">
                    @else


                    @endif</div></div>
@endforeach

 </div></div><!-- .card-innr --></div><!-- .card --></div> </div></div></div><!-- .container --></div>

@endsection
