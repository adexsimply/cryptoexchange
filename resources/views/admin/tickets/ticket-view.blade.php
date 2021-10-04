@extends('include.admindashboard')

@section('body')
<div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-12 col-xl-7 text-center"><h2 class="page-title">View Message</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row justify-content-center"><div class="col-xl-9 col-lg-10"><div class="content-area card"><div class="card-innr"><div class="card-head"><h6 class="card-title text-center">{{$inbox->title}}</h6></div><div class="gaps-1x"></div><!-- .gaps --><table class="emails-wraper"><tr><td class="pdt-4x pdb-4x"><table class="email-header"><tbody><tr><td class="text-center pdb-2-5x"><a href="#">
<div class="user-photo">
@if( file_exists($inbox->user->image))
                        <img src=" {{url($inbox->user->image)}} " width="100"
                             alt="Profile Pic">
                    @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " width="100"
                             alt="Profile Pic">
                    @endif </div></a><p class="email-title">{{$inbox->user->username}}</p></td></tr></tbody></table><table class="email-body"><tbody><tr><p class="mgb-1x">{{$inbox->details}}.</p><p class="mgb-1-5x">
@if($inbox->image > 0)
 <span class="data-detsails-docs-title">File Attachment</span><div class="data-doc-item data-doc-item-lg"><div class="data-doc-image">
                        <img src="{{url('uploads/messages')}}/{{$inbox->image}}" width="100"
                             alt="Profile Pic">


                    </div><ul class="data-doc-actions"><li><a href="{{url('uploads/messages')}}/{{$inbox->image}}"><em class="ti ti-import"></em></a></li></ul></div>
@endif

<form role="form" method="POST" action="{{route('ticket.reply')}}" enctype="multipart/form-data">
{{ csrf_field() }}

<input name="subject" hidden value="RE: {{$inbox->title}}">
<input name="id" hidden value="{{$inbox->user_id}}">


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea required name="details" class="input-bordered input-textarea"></textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Reply Message</button></form></div>




                </p></td></tr></tbody></table><table class="email-footer"><tbody><tr><td class="text-center pdt-2-5x pdl-2x pdr-2x"></td></tr></tbody></table></td></tr></table><div class="hr"></div></div></div></div></div></div><!-- .page-content -->
@endsection
