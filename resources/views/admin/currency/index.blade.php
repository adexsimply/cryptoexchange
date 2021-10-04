@extends('include.admindashboard')

@section('body')
    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Cryptocurrency List</h4></div><table class="data-table dt-init user-list"><thead><tr class="data-item data-head"><th class="data-col dt-user">Name</th><th class="data-col dt-email">Address</th><th class="data-col dt-token">Rate</th>  <th class="data-col dt-status"><div class="dt-status-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>
<a href="#" data-toggle="modal" data-target="#createcoin" class="btn btn-sm btn-primary btn-outline"><em class="ti ti-trash"></em> Create New</a>
 @foreach($currency as $k=>$data)
<tr class="data-item"><td class="data-col dt-user"><span class="lead user-name">{{$data->name }}</span><span class="sub user-id"></span></td><td class="data-col dt-email"><span class="sub sub-s2 sub-email">{{$data->payment_id}}</span></td><td class="data-col dt-token"><span class="lead lead-btoken">1 USD =
    {{$data->price}} {{$data->symbol}}</span></td>

<td class="data-col dt-status">

@if($data->status == 1)
<span class="dt-status-md badge badge-outline badge-success badge-md">Active</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-success badge-md">A</span>
@else
<span class="dt-status-md badge badge-outline badge-danger badge-md">Inactive</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-danger badge-md">I</span>
@endif

</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('currency.edit',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li><li><a href="{{route('activatecoin',$data->id)}}"><em class="ti ti-check"></em> Activate</a></li>
<li><a href="{{route('deactivatecoin',$data->id)}}"><em class="ti ti-na"></em> Deactivate</a></li>

<li><a href="{{route('deletecoin',$data->id)}}"><em class="ti ti-trash"></em> Delete</a></li></ul></div></div></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->





<!-- .modal-dialog --></div><!-- Modal End --><div class="modal fade" id="createcoin" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Create New Currency</h4> <p>Fill the form below to create a new cryptocurrency for the system. Please note that the currency symbol has to conform with the standart blockchain currency symbol. Please check <a href="https://min-api.cryptocompare.com">Here</a> to see list of supported currency symbols.</p>

<div class="input-item input-with-label">

<form role="form" method="POST" action="{{route('currency.store')}}" name="editForm" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight">Currency  Name:</label>
                                        <div class="input-group">
                                            <input type="text" class="input-bordered" placeholder="Currency  Name" value="{{old('name')}}"
                                                   name="name">

                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Currency 	Symbol:</label>
                                        <input type="text"class="input-bordered"  placeholder="Currency Symbol" value="{{old('symbol')}}"
                                               name="symbol">


                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight">Price:</label>
                                        <div class="input-group">

                                            <input type="text" name="price"  value="{{old('price')}}" class="input-bordered"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                        </div>

                                    </div>





                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight"> Payment Wallet</label>
                                            <input type="text" name="payment_id"  value="{{old('payment_id')}}" class="input-bordered"
                                                   placeholder="Payment Wallet Address" >

                                    </div>





                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Buying Rate</label>
                                        <div class="input-group">
                                            <input type="text" name="buy" value="{{old('buy')}}" class="input-bordered"
                                                   placeholder="0.00" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">

                                        </div>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Selling Rate</label>
                                        <div class="input-group">
                                            <input type="text" name="sell"  value="{{old('sell')}}" class="input-bordered"
                                                   placeholder="0.00" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">


                                        </div>

                                    </div>
                                </div>




                            </div><!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Create Currency</button></form></li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pay-online" class="link link-primary">Cancel</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
@endsection
