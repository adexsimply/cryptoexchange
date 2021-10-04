@extends('include.front')
@section('content')

<!-- .header-banner @e --></header><main class="nk-pages"><section class="section bg-white"><div class="container"><div class="nk-block nk-block-blog"><div class="row"><div class="col-12"><div class="blog-details"><div class="row justify-content-center"><div class="col-xl-10 col-lg-12"><div class="blog-featured">@if( file_exists($blog->image))
                      <center>  <img src="{{asset($blog->image)}}" width="100"
                             alt="Notification Image">
                    </center> @else
                    @endif
</div></div><div class="col-xl-8 col-lg-10"><ul class="blog-meta"><li><a href="#">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</a></li><li><a href="#">{{$blog->category->name}}</a></li></ul><div class="blog-content"><h2 class="title"><a href="#">{{$blog->title}}.</a></h2><p>{!! $blog->details !!}.</p></div> </div><!-- .row --></div><!-- .block @e --></div> <!-- .nk-ovm --></section>

 </div><!-- .nk-block --></div><!-- .container --></section><!-- .section --></main>
@endsection


