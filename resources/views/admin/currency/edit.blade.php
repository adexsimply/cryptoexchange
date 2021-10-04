@extends('include.admindashboard')

@section('body')
  <div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h2 class="page-title">View Cryptocurrency</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row"> <div class="col-lg-12"><div class="content-area card"><div class="card-innr card-innr-fix2"><div class="card-head"><h6 class="card-title">Update Currency</h6></div><div class="gaps-1x"></div><!-- .gaps -->

  <form role="form" method="POST" action="{{route('postcoin' )}}"
     name="editForm" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="row">



  <div class="col-xl-6 col-sm-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Currency Name</label><input type="text" class="input-bordered"
                                           name="name"        placeholder="Currency Name" value="{{$currency->name}}">
<input hidden name="id" value="{{$currency->id}}">

                                                   </div></div><div class="col-xl-6 col-sm-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Currency Symbol</label> <input type="text" class="input-bordered"
                                               placeholder="Currency Symbol" value="{{$currency->symbol}}"
                                               name="symbol"></div></div><div class="col-xl-6 col-sm-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Currency Price</label><input type="text" name="price" value="{{$currency->price}}"
                                                  class="input-bordered"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"></div></div><div class="col-xl-6 col-sm-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Wallet Address</label> <input type="text" name="payment_id" value="{{$currency->payment_id}}"
                                               name="payment_id" class="input-bordered"
                                               placeholder="Payment Id"></div></div></div><div class="row"><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Sell Rate</label> <input type="text" name="sell" value="{{$currency->sell}}" class="input-bordered"
                                                   placeholder="0.00"
                                                   ></div></div><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Purchase Rate</label> <input type="text" name="buy" value="{{$currency->buy}}"
                                                   class="input-bordered"
                                                   placeholder="0.00"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"></div></div></div> </div><!-- .card-innr -->

    <div class="form-group col-md-12 ">
                                        <button class="btn btn-primary btn-lg">Update</button></form>
                                    </div>
</div><!-- .card -->

                                                   </div> </div><!-- .card-innr --></div><!-- .card --></div></div></div><!-- .container --></div>
@stop
