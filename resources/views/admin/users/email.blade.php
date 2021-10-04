@extends('include.admindashboard')

@section('body')

<div class="page-header"><div class="container"><div class="row justify-content-center"> </div></div><!-- .container --><center><div class="col-lg-8 col-xl-7 text-center"><h4 class="page-title">Send New Message</h4></div></center></div><div class="page-content"><div class="container"><div class="row">


<div class="col-lg-12">

<form role="form" method="POST" action="{{route('send.email')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
<div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Send {{$user->username}} A Message</h6></div><div class="gaps-1x"></div><!-- .gaps --><form action="#"><div class="row">
<input type="text" name="reciver" hidden class="form-control form-control-lg" value="{{$user->fname}} {{$user->lname}}"  readonly>
<input type="email" name="emailto" hidden class="form-control form-control-lg" value="{{$user->email}}" readonly > </div>
<input name="id" hidden value="{{$user->id}}">





<div class="input-item input-with-label"><label class="input-item-label text-exlight">Message Subject</label><input class="input-bordered" name="subject" type="text"></div><div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea name="emailMessage" class="input-bordered input-textarea"></textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Send Message</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .col --></div><!-- .row --></div><!-- .container --></div>


@endsection
