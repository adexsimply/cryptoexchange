@extends('include.userdashboard')

@section('content')

<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr">

  <div class="card-head"><h6 class="card-title text-center">Subject: {{$inbox->title}}</h6></div><div class="gaps-1x"></div><!-- .gaps --><table class="email-wraper"><tr><td class="pdt-4x pdb-4x"><table class="email-header"><tbody><tr><td class="text-center pdb-2-5x"><a href="#"><center><img class="email-logo" src="{{asset('assets/images/logo/logo.png')}}" width="60" alt="logo"></center></a><p class="email-title"></p></td></tr></tbody></table><table class="email-body"><tbody><tr><td class="text-center pd-3x pdb-3x"><p class="mgb-1x">{{$inbox->details}}. </p></td></tr></tbody></table><table class="email-footer"><tbody><tr><td class="text-center pdt-2-5x pdl-2x pdr-2x"><p class="email-copyright-text">{!! date(' D-d-M-Y', strtotime($inbox->created_at)) !!} <br>  <a href="#">{{$basic->sitename}}</a>.</p></td></tr></tbody></table></td></tr></table></div><!-- .container --></div></div></div><!-- .page-content -->

@endsection
