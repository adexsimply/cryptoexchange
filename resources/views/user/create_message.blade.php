@extends('include.userdashboard')

@section('content')

<div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h2 class="page-title">Create New Message</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row">


<div class="col-lg-12">

<form action="{{route('post.message')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Send Us A Message</h6></div><div class="gaps-1x"></div><!-- .gaps --><form action="#"><div class="row"> <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Message Code</label><input value="{{$code}}" name="code" class="input-bordered" readonly type="text"><label class="input-item-label text-exlight"><small> (Please keep this as you may need it to query your message)</small></label></div></div></div>


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"><label for="file-01">Choose a file</label>
</div>
<small> (Please attach file to your message if there is any or leave empty and proceed)</small>
</div>



<div class="input-item input-with-label"><label class="input-item-label text-exlight">Message Subject</label><input class="input-bordered" name="subject" type="text"></div><div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea name="body" class="input-bordered input-textarea"></textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Send Message</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .col --></div><!-- .row --></div><!-- .container --></div>


@endsection
