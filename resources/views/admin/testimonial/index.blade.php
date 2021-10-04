@extends('include.admindashboard')

@section('body')
   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Testimonial List</h4></div><table class="data-table dt-init user-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Username</th><th class="data-col dt-token  col-50">Testimonial</th> <th class="data-col dt-type"><div class="dt-type-text">Status</div></th> </tr></thead><tbody>

<a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Create <span class="d-none d-xl-inline-block">New Testimonial</span></span><em class="ti ti-plus"></em></a>
@foreach($test as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">

@if($data->status > 0)
<div class="data-state data-state-approved"><span class="d-none">Active</span></div>
@else
<div class="data-state data-state-pending"><span class="d-none">Active</span></div>
@endif



<div class="fake-class"><span class="lead tnx-id">
@if($data->user_id < 2)
Admin
@else
{{$data->user->username}}
@endif
</span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$data->details}}</span> </td> <td class="data-col dt-type">
@if($data->status > 0)
<span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">Ac</span>
@else
<span class="dt-type-md badge badge-outline badge-warning badge-md">Inactive</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">Ic</span>
@endif


</td><td class="data-col text-right"><div class="relative d-inline-block d-md-none"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-center-left pd-2x"><ul class="data-action-list">

<li><a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Update <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.testidel',$data->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></div></div><ul class="data-action-list d-none d-md-inline-flex"><li><a href="#" data-toggle="modal" data-target="#my{{$data->id}}Modal" class="btn btn-auto btn-primary btn-xs"><span>Update <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.testidel',$data->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></td></tr>


 <!-- Modal for Edit button -->
    <div class="modal fade" id="my{{$data->id}}Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Update Testimonial </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
               <form role="form" method="POST" action="{{route('update.testi')}}">
                        {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="input-item-label text-exlight"> Testimonial Details:</label>
                            <textarea name="body" placeholder="Body" class="edit_account input-bordered" rows="3">{{$data->details}}</textarea>
                        </div>

                         <div class="form-group">
                            <label class="input-item-label text-exlight">Status</label>
                        <select name="status" class="input-bordered select-block">
                            <option value="1">Activate</option>
                            <option value="0">Deactivate</option>
                        </select>
                            <input value="{{$data->id}}" name="id" hidden required>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-primary">Update Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach

<!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Create New Testimonial </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
               <form role="form" method="POST" action="{{route('create.testi')}}">
                        {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="input-item-label text-exlight"> Testimonial Details</label>
                            <textarea name="details"  placeholder="Enter Testimonial" class="edit_account input-bordered"  rows="3"> </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-primary">Create Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
