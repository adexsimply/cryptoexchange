@extends('include.userdashboard')

@section('content')
   <div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title card-title-lg">Frequently Question Answers</h4><p>We have carefully selected some range of frequently asked questions for you. </p><p>If your question is not included in this FAQ, please feel free to contact us.</p></div><div class="content"><h4 class="text-secondary">General Questions</h4>

<div class="accordion-simple" id="faqList-1">

@foreach($faq as $key => $faq)
<div class="accordion-item"><h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-{{$faq->id}}"> {!! $faq->title !!}  </h6><div id="collapse-1-{{$faq->id}}" class="collapse" data-parent="#faqList-1"><div class="accordion-content"><p>{!! $faq->description !!}</p></div></div></div><!-- .accordion-item -->
@endforeach


</div>  </div></div></div><!-- .card --></div> </div><!-- .row --></div><!-- .container --></div><!-- .page-content -->
@stop
