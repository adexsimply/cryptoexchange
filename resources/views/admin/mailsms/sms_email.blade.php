@extends('include.admindashboard')

@section('body')
    <div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h2 class="page-title">Email/SMS</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row">

    <div class="col-lg-12"><div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Email&SMS Settings</h6></div><div class="gaps-1x"></div><!-- .gaps --><form role="form" method="POST" action="{{route('template.update')}}" enctype="multipart/form-data">

{{ csrf_field() }}
<div class="row"> <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">SMS API</label><input name="smsapi" class="input-bordered"  value="{{$temp->smsapi}}" type="text"></div></div></div><div class="input-item input-with-label"><label class="input-item-label text-exlight">Email Sender</label><input type="email" name="esender" value="{{$temp->esender}}" class="input-bordered" type="text"></div><div class="input-item input-with-label"><label class="input-item-label text-exlight">Message Template</label><textarea id="emessage" name="emessage" class="input-bordered input-textarea">{{$temp->emessage}}</textarea></div><div class="gaps-1x"></div><button class="btn btn-primary" type="submit">Update</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .card --></div></div></div><!-- .container --></div>
@endsection

@section('script')
	<script src="{{asset('assets/admin/js/nicEdit-latest.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
        new nicEditor().panelInstance('emessage');
	</script>
@stop
