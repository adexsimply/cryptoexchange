@extends('include.admindashboard')

@section('body')

<div class="page-header"><div class="container"><div class="row justify-content-center"> </div></div><!-- .container --><center><div class="col-lg-8 col-xl-7 text-center"><h4 class="page-title">Create New Notification</h4></div></center></div><div class="page-content"><div class="container"><div class="row">


<div class="col-lg-12">

<form role="form" method="POST" action="{{route('send.notification')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
<div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Create New Notification</h6></div><div class="gaps-1x"></div><!-- .gaps --><div class="row">
 </div>





<div class="input-item input-with-label"><label class="input-item-label text-exlight">Notification Title</label><input class="input-bordered" name="title" type="text"></div>

<div class="input-item input-with-label"><label class="input-item-label text-exlight">Notification Category</label><select name="cat_id" id="cat_id" class="select-bordered select-block">
                                    <option value="">Select Category</option>
                                    @foreach($category as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select></div>


 <div class="input-item input-with-label"><label for="nationality" class="input-item-label text-exlight">Upload Avatar</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="image" accept="image/*"><label for="file-01">Choose a file</label></div></div>


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea name="details" class="input-bordered input-textarea"></textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Post Notification</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .col --></div><!-- .row --></div><!-- .container --></div>


@endsection
