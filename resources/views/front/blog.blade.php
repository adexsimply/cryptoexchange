@extends('include.front')
@section('content')

<div class="header-banner bg-theme-grad"><div class="nk-banner"><div class="banner banner-page"><div class="banner-wrap"><div class="container"><div class="row justify-content-center"><div class="col-xl-6 col-lg-9"><div class="banner-caption cpn tc-light text-center"><div class="cpn-head"><h2 class="title ttu">Blog & News</h2><p>Our Blog, News & Gallery.</p></div></div></div></div></div></div></div></div><!-- .nk-banner --><div class="nk-ovm shape-a-sm"></div></div><!-- .header-banner @e --></header><main class="nk-pages"><section class="section bg-white"><div class="container">

<div class="nk-block nk-block-blog"><div class="row">

@foreach($blogs as $data)
<div class="col-lg-4 col-sm-6"><div class="blog"><div class="blog-photo">@if( file_exists($data->image))
                        <img src="{{asset($data->image)}}" width="100"
                             alt="Notification Image">
                    @else


                    @endif</div><div class="blog-text"><ul class="blog-meta"><li><a href="{{route('blogview',$data->id)}}">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</a></li><li><a href="{{route('blogview',$data->id)}}">{{$data->category->name}}</a></li></ul><h4 class="title title-sm"><a href="{{route('blogview',$data->id)}}">{{$data->title}}.</a></h4><p>{{substr($data->details, 0, 25)}}....</p></div></div><!-- .blog --></div>
@endforeach

 </div><!-- .nk-block --></div><!-- .container --></section><!-- .section --></main>
@endsection


