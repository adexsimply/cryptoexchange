@extends('include.userdashboard')

@section('content')

<div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h2 class="page-title">Create New Testimonial</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row">


<div class="col-lg-12">

<form action="{{route('post.testimonial')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Your Testimonial Will Appear On The Front Page When Approved</h6></div><div class="gaps-1x"></div><!-- .gaps --><form action="#"><div class="row"> <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Testimonial Code</label><input value="{{$code}}" name="code" class="input-bordered" name="code" readonly type="text"><label class="input-item-label text-exlight"><small> (Please keep this as you may need it to qualify for offers and bonus)</small></label></div></div></div>

<div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Testimonial</label><textarea name="body" class="input-bordered input-textarea"></textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Post Testimonial</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .col --></div><!-- .row --></div><!-- .container --></div>


@endsection
