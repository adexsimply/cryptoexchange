@extends('include.admindashboard')

@section('body')
  <div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Payment Gateways</h4></div><table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Name</th> <th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>


@foreach($gateways as $k=>$gateway)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">
@if($gateway->status == 1)
<div class="data-state data-state-approved"><span class="d-none">Active</span></div>
@else
<div class="data-state data-state-pending"><span class="d-none">Inactive</span></div>
@endif
<div class="fake-class"><span class="lead tnx-id">{{ $gateway->main_name }}</span><span class="sub sub-date">{{$gateway->updated_at}}</span></div></div></td>  <td class="data-col dt-type">

@if($gateway->status == 1)
<span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
@else
<span class="dt-type-md badge badge-outline badge-warning badge-md">Inactive</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">I</span>
@endif

</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="#" data-toggle="modal" data-target="#editModal{{$gateway->id}}"><em class="ti ti-eye"></em> View Details</a></li>

@if($gateway->status != 1)
<li><a href="{{route('activate.gateway',$gateway->id)}}"><em class="ti ti-check-box"></em> Activate</a></li>
@else
<li><a href="{{route('deactivate.gateway', $gateway->id)}}"><em class="ti ti-na"></em> Deactivate</a></li>
@endif </ul></div></div></td></tr><!-- .data-item -->
<!-- Modal for Edit button -->
                                <div class="modal fade editModal" id="editModal{{$gateway->id}}" tabindex="-1"
                                     role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
<a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Edit
                                                    <strong>{{$gateway->name}}</strong></h4>

                                            </div>
                                            <form method="post" action="{{route('update.gateway')}}"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}

                                                <input class="input-bordered abir_id" value="{{$gateway->id}}"
                                                       type="hidden" name="id">
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6><strong>Name of Gateway</strong></h6>
                                                                <input type="text" value="{{$gateway->name}}"
                                                                       class="input-bordered" id="name" name="name">
                                                            </div>
                                                            <div class="col-md-6">

                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">

                                                                    </div>

                                                                    <div class="input-group-prepend">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    @if($gateway->id==101)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>PAYPAL BUSINESS EMAIL</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                    @elseif($gateway->id==102)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>PM USD ACCOUNT</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h5 for="val2"><strong>ALTERNATE PASSPHRASE</strong></h5>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>

                                                    @elseif($gateway->id==103)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>SECRET KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>PUBLISHABLE KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>

                                                    @elseif($gateway->id==104)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Merchant Email</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Secret KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==105)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Merchant ID</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Merchant KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val3"><strong>Website </strong></h6>
                                                            <input type="text" value="{{$gateway->val3}}"
                                                                   class="input-bordered" id="val3" name="val3">
                                                        </div>

                                                        <div class="form-group">
                                                            <h6 for="val4"><strong>Industry Type </strong></h6>
                                                            <input type="text" value="{{$gateway->val4}}"
                                                                   class="input-bordered" id="val4" name="val4">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val5"><strong>Channel ID </strong></h6>
                                                            <input type="text" value="{{$gateway->val5}}"
                                                                   class="input-bordered" id="val5" name="val5">
                                                        </div>

                                                        <div class="form-group">
                                                            <h6 for="val6"><strong>Transaction URL </strong></h6>
                                                            <input type="text" value="{{$gateway->val6}}"
                                                                   class="input-bordered" id="val6" name="val6">
                                                        </div>

                                                        <div class="form-group">
                                                            <h6 for="val7"><strong>Transaction Status URL </strong></h6>
                                                            <input type="text" value="{{$gateway->val7}}"
                                                                   class="input-bordered" id="val7" name="val7">
                                                        </div>

                                                    @elseif($gateway->id==106)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Merchant ID</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Secret ID</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>

                                                    @elseif($gateway->id==107)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public Key</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Secret Key</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==108)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Merchant ID</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                    @elseif($gateway->id==501)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>API KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>XPUB CODE</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==502)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>API KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>API PIN</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==503)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>API KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>API PIN</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==504)
                                                        <div class="form-group">
                                                            <h5 for="val1"><strong>API KEY</strong></h5>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>API PIN</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==505)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==506)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==507)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==508)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==509)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                    @elseif($gateway->id==510)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Public KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>Private KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>

                                                    @elseif($gateway->id==512)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>SECRET KEY</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                    @elseif($gateway->id==513)
                                                        <div class="form-group">
                                                            <h6 for="val1"><strong>Merchant ID</strong></h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val2"><strong>API åPublic Key</strong></h6>
                                                            <input type="text" value="{{$gateway->val2}}"
                                                                   class="input-bordered" id="val2" name="val2">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 for="val3"><strong>API Secret Key</strong></h6>
                                                            <input type="text" value="{{$gateway->val3}}"
                                                                   class="input-bordered" id="val2" name="val3">
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <h6 for="val1">
                                                                <storng>Payment Details</storng>
                                                            </h6>
                                                            <input type="text" value="{{$gateway->val1}}"
                                                                   class="input-bordered" id="val1" name="val1">
                                                        </div>
                                                    @endif

                                                    <div class="form-group">
                                                        <h6 for="status"><strong>Status</strong></h6>
                                                        <select class="input-bordered" name="status">
                                                            <option value="1" {{ $gateway->status == "1" ? 'selected' : '' }}>
                                                                Active
                                                            </option>
                                                            <option value="0" {{ $gateway->status == "0" ? 'selected' : '' }}>
                                                                Deactive
                                                            </option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">


                                                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

 <!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->

@endsection
