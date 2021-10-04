@extends('include.admindashboard')

@section('body')
  <!-- .topbar-wrap --><div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Frequently Asked Questions</h4></div>


<a href="{{route('faqs-create')}}" class="btn btn-primary btn-sm pull-right ">
                        <i class="fa fa-plus"></i> Create Faqs
</a>


  <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Question</th><th class="data-col dt-token">Answer</th> <th class="data-col"></th></tr></thead><tbody>


@foreach($faqs as $key => $f)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-progress"> </div><div class="fake-class"><span class=" ">{{$f->title}}</span><span class="sub sub-date">{{$f->updated_at}}</span></div></div></td><td class="data-col dt-token"><span class=" ">{!! substr($f->description, 0, 80) !!}'.......</span> </td>  <td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-primary btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"> <li><a href="{{ route('faqs-edit',$f->id) }}"><em class="ti ti-pencil"></em> Edit</a></li><li><a href="{{ route('faqs-delete',$f->id) }}"><em class="ti ti-trash"></em> Delete</a></li></ul></div></div></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@stop
