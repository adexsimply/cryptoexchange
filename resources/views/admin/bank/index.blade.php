@extends('include.admindashboard')

@section('body')
   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Bank List</h4></div><table class="data-table dt-init user-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Bank Name</th><th class="data-col dt-token">Account Details</th> <th class="data-col dt-type"><div class="dt-type-text">Status</div></th> </tr></thead><tbody>

<a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Create <span class="d-none d-xl-inline-block">New</span></span><em class="ti ti-plus"></em></a>
@foreach($banks as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-approved"><span class="d-none">Active</span></div><div class="fake-class"><span class="lead tnx-id">{{$data->name}}</span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$data->account}}</span> </td> <td class="data-col dt-type"><span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span></td><td class="data-col text-right"><div class="relative d-inline-block d-md-none"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-center-left pd-2x"><ul class="data-action-list"><li><a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Edit <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.bank.delete',$data->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></div></div><ul class="data-action-list d-none d-md-inline-flex"><li><a href="#" data-toggle="modal" data-target="#my{{$data->id}}Modal" class="btn btn-auto btn-primary btn-xs"><span>Edit <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.bank.delete',$data->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></td></tr>


 <!-- Modal for Edit button -->
    <div class="modal fade" id="my{{$data->id}}Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong> Bank </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
               <form role="form" method="POST" action="{{route('post.bank')}}">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-item-label text-exlight">Bank Name:</label>
                            <input value="{{$data->id}}" class="form-control form-control-lg abir_id" type="hidden" name="id">
                            <input value="{{$data->name}}" class="input-bordered abir_name" name="name" placeholder="Bank Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="input-item-label text-exlight"> Payment Details:</label>
                            <textarea name="account" placeholder="Payment Details" class="edit_account input-bordered" rows="3">{{$data->account}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
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
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Create New Bank </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
               <form role="form" method="POST" action="{{route('create.bank')}}">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-item-label text-exlight">Bank Name:</label>

                            <input class="input-bordered abir_name" name="name" placeholder="Bank Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="input-item-label text-exlight"> Payment Details:</label>
                            <textarea name="account"  placeholder="Payment Details" class="edit_account input-bordered"  rows="3"> </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
