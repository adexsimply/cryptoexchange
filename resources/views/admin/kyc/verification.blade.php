@extends('include.admindashboard')

@section('body')
<div class="page-content">
  <div class="container">
    <div class="content-area card">
      <div class="card-innr">
        <div class="card-head">
          <h4 class="card-title">KYC List</h4>
        </div>
        <table class="data-table dt-init kyc-list">
          <thead>
            <tr class="data-item data-head">
              <th class="data-col dt-user">User</th>
              <th class="data-col dt-user">Doc Type</th>
              <th class="data-col dt-doc-front">User Selfie</th>
              <th class="data-col dt-doc-front">Documents</th>
              <th class="data-col dt-doc-back">&nbsp;</th>
              <th class="data-col dt-status">Status</th>
              <th class="data-col"></th>
            </tr>
          </thead>
          <tbody>

            @foreach($kyc as $k=>$data)
            <tr class="data-item">
              <td class="data-col dt-user"><span class="lead user-name">{{$data->user->username}}</span><span class="sub user-id">{{$data->user->email}}</span></td>
              <td class="data-col dt-user"><span class="sub sub-s2 sub-dtype">{{$data->type}}</span></td>
              <td class="data-col dt-doc-front"><a href="{{url('kyc')}}/{{$data->image1}}" class="image-popup">Selfie Image</a> &nbsp; &nbsp; 
              <a href="{{$data->selfie}}" download><em class="fas fa-download"></em></a></td>

              

              <td class="data-col dt-doc-front"><a href="{{url('kyc')}}/{{$data->image1}}" class="image-popup">Front Part</a> &nbsp; &nbsp; <a href="{{url('kyc')}}/{{$data->image1}}" download><em class="fas fa-download"></em></a></td>

              <td class="data-col dt-doc-back"><a href="{{url('kyc')}}/{{$data->image1}}" class="image-popup">Back Part</a> &nbsp; &nbsp; <a href="{{url('kyc')}}/{{$data->image2}}" download><em class="fas fa-download"></em></a></td>

              <td class="data-col dt-status">

                @if($data->status == 1)
                <span class="dt-status-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-status-sm badge badge-sq badge-outline badge-success badge-md">A</span>

                @elseif($data->status == 2)
                <span class="dt-status-md badge badge-outline badge-danger badge-md">Rejected</span><span class="dt-status-sm badge badge-sq badge-outline badge-danger badge-md">R</span>
                @else
                <span class="dt-status-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-status-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                @endif

              </td>
              <td class="data-col text-right">
                <div class="relative d-inline-block"><a href="{{route('kycview',$data->id)}}" class="btn btn-light-alt btn-xs btn-icon"><em class="ti ti-more-alt"></em></a> </div>
              </td>
            </tr><!-- .data-item -->
            @endforeach

            <!-- .data-item -->
          </tbody>
        </table>
      </div><!-- .card-innr -->
    </div><!-- .card -->
  </div><!-- .container -->
</div><!-- .page-content -->

@stop