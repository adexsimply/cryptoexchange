@extends('include.admindashboard')

@section('body')


<script>
  function goBack() {
    window.history.back()
  }
</script>
<div class="page-content">
  <div class="container">
    <div class="card content-area">
      <div class="card-innr">
        <div class="card-head d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">KYC Details</h4>
          <div class="d-flex align-items-center guttar-20px">
            <div class="flex-col d-sm-block d-none"><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary"><em class="fas fa-arrow-left mr-3"></em>Back</a></div>
            <div class="flex-col d-sm-none"><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary"><em class="fas fa-arrow-left"></em></a></div>
            <div class="relative d-inline-block"><a href="#" class="btn btn-dark btn-sm btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
              <div class="toggle-class dropdown-content dropdown-content-top-left">
                <ul class="dropdown-list">
                  <li><a href="{{route('kycapprove',$kyc->id)}}"><em class="ti ti-check"></em> Approve</a></li>
                  <li><a href="{{route('kycreject',$kyc->id)}}"><em class="ti ti-na"></em> Cancel</a></li>
                  <li><a href="{{route('kycdelete',$kyc->id)}}"><em class="ti ti-trash"></em> Delete</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="gaps-1-5x"></div>
        <div class="data-details d-md-flex flex-wrap align-items-center justify-content-between">
          <div class="fake-class"><span class="data-details-title">Submited By</span><span class="data-details-info">{{$kyc->user->username}}</span></div>
          <div class="fake-class"><span class="data-details-title">Document Type</span><span class="data-details-info"> {{$kyc->type}}</span></div>
          <div class="fake-class"><span class="data-details-title">Document Number:</span><span class="data-details-info"> {{$kyc->number}}</span></div>
          <div class="fake-class"><span class="data-details-title">Document Expiry Date</span><span class="data-details-info"> {{$kyc->date}}</span></div>
          <div class="fake-class">@if($kyc->status == 1)
            <span class="dt-status-md badge badge-outldine badge-success badge-md">Approved</span>
            @elseif($kyc->status == 2)
            <span class="dt-status-md badge badge-outldine badge-danger badge-md">Rejected</span>
            @else
            <span class="dt-status-md badge badge-outlidne badge-warning badge-md">Pending</span>
            @endif
          </div>
          <div class="gaps-2x w-100 d-none d-md-block"></div>
          <div class="w-100"><span class="data-details-title">Submission Date</span><span class="data-details-info">{{$kyc->created_at}}</span></div>
        </div>
        <div class="gaps-3x"></div>
        <h6 class="card-sub-title">Personal Information</h6>
        <ul class="data-details-list">
          <li>
            <div class="data-details-head">First Name</div>
            <div class="data-details-des">{{$kyc->user->fname}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Last Name</div>
            <div class="data-details-des">{{$kyc->user->lname}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Email Address</div>
            <div class="data-details-des">{{$kyc->user->email}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Phone Number</div>
            <div class="data-details-des">{{$kyc->user->phone}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Date of Birth</div>
            <div class="data-details-des">{{$kyc->user->dob}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Full Address</div>
            <div class="data-details-des">{{$kyc->user->address}}, {{$kyc->user->city}}, {{$kyc->user->zip_code}}.</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">Country of Residence</div>
            <div class="data-details-des">{{$kyc->user->country}}</div>
          </li><!-- li -->
          <li>
            <div class="data-details-head">User Image</div>
            <div class="data-details-des"><span>
                <div class="user-photo"> @if( file_exists($kyc->user->image))
                  <img src=" {{url($kyc->user->image)}} " width="100" alt="Profile Pic">
                  @else

                  <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">
                  @endif
                </div>
              </span></div>
          </li><!-- li -->
        </ul>
        <div class="gaps-3x"></div>
        <h6 class="card-sub-title">Uploaded Documnets</h6>
        <ul class="data-details-list">
          <li>
            <div class="data-details-head">Type: {{$kyc->type}}
            </div>
            <ul class="data-details-docs">
              <li><span class="data-details-docs-title">Selfie Image</span>
                <div class="data-doc-item data-doc-item-lg">
                  <div class="data-doc-image"><img src="{{$kyc->selfie}}" alt="Selfie"></div>
                  <ul class="data-doc-actions">
                    <li><a href="{{$kyc->selfie}}" download><em class="ti ti-import"></em></a></li>
                  </ul>
                </div>
              </li><!-- li -->
              <li><span class="data-details-docs-title">Front Side</span>
                <div class="data-doc-item data-doc-item-lg">
                  <div class="data-doc-image"><img src="{{url('kyc')}}/{{$kyc->image1}}" alt="passport"></div>
                  <ul class="data-doc-actions">
                    <li><a href="{{url('kyc')}}/{{$kyc->image1}}" download><em class="ti ti-import"></em></a></li>
                  </ul>
                </div>
              </li><!-- li -->
              <li><span class="data-details-docs-title">Back Side</span>
                <div class="data-doc-item data-doc-item-lg">
                  <div class="data-doc-image"><img src="{{url('kyc')}}/{{$kyc->image2}}" alt="passport"></div>
                  <ul class="data-doc-actions">
                    <li><a href="{{url('kyc')}}/{{$kyc->image2}}" download><em class="ti ti-import"></em></a></li>
                  </ul>
                </div>
              </li><!-- li -->
            </ul>
          </li><!-- li -->
        </ul>
      </div><!-- .card-innr -->
    </div><!-- .card -->
  </div><!-- .container -->
</div><!-- .page-content -->
<div class="footer-bar">
  <div class="container">
    <div class="row align-items-center justify-content-center"></div>
    @stop