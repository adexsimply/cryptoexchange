@extends('include.front')
@section('content')

<!-- Banner @s -->
<div class="header-banner bg-theme-grad-s2">
  <div class="nk-banner">
    <div class="banner banner-fs banner-single banner-s1 banner-s1-overlay" style="background-color: #3CB4C4 !important;">
      <div class="banner-wrap">
        <div class="container">
          <div class="row align-items-center justify-content-center justify-content-lg-between gutter-vr-60px">
            <div class="col-lg-6 col-xl-6 text-center text-lg-left">
              <div class="banner-caption tc-light">
                <div class="cpn-head mt-0">
                  <h1 class="title title-thin title-xl-2 animated" data-animate="fadeInUp" data-delay="1.25">{{$basic->htitle}}</h1>
                </div>
                <div class="cpn-text cpn-text-s2">
                  <p class="lead-s2 lead-light animated" data-animate="fadeInUp" data-delay="1.35">{{$basic->hstitle}}</p>
                </div>
                <div class="cpn-btns">
                  <ul class="btn-grp animated" data-animate="fadeInUp" data-delay="1.45">
                    <li><a class="btn btn-md btn-primary btn-outline" href="{{route('buy')}}">Buy Coin</a></li>
                    <li><a class="btn btn-md btn-primary btn-outline" href="{{route('sell')}}">Sell Coin</a></li>
                  </ul>
                </div>
                <div class="cpn-social">
                  <h4 class="title-xs animated" data-animate="fadeInUp" data-delay="1.55">JOIN OUR COMMUNITY</h4>
                  <ul class="social">
                    <li class="animated" data-animate="fadeInUp" data-delay="1.7"><a href="{{$basic->facebook}}"><em class="social-icon fab fa-facebook-f"></em></a></li>
                    <li class="animated" data-animate="fadeInUp" data-delay="1.75"><a href="{{$basic->twitter}}"><em class="social-icon fab fa-twitter"></em></a></li>
                    <li class="animated" data-animate="fadeInUp" data-delay="1.8"><a href="{{$basic->google}}"><em class="social-icon fab fa-google-plus"></em></a></li>
                    <li class="animated" data-animate="fadeInUp" data-delay="1.8"><a href="{{$basic->instagram}}"><em class="social-icon fab fa-instagram"></em></a></li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- .col -->
            <div class="col-lg-5 col-sm-6 col-md-6 col-mb-6 order-lg-last">
              <div class="banner-gfx text-center animated" data-animate="fadeInUp" data-delay="1.4"><img src="{{asset('assets/images/headerimg.jpg')}}" alt="header"></div>
            </div><!-- .col -->


          </div><!-- .row -->
        </div>
      </div>
    </div>
  </div>


  <!-- .nk-banner -->
  <div class="nk-ovm shape-q"></div><!-- Place Particle Js -->
  <div id="particles-bg" class="particles-container particles-bg" data-pt-base="#00c0fa" data-pt-base-op=".3" data-pt-line="#2b56f5" data-pt-line-op=".5" data-pt-shape="#00c0fa" data-pt-shape-op=".2"></div>
</div><!-- .header-banner @e -->
</header>
<main class="nk-pages">
  <section class="section bg-light" id="about" style="background-color: #DAF0F3 !important;">
    <div class="container">
      <!-- Block @s -->
      <div class="nk-block nk-block-features-s2">
        <div class="row align-items-center flex-row-reverse gutter-vr-30px">
          <div class="col-lg-5">
            <div class="gfx py-4 mx-auto mx-lg-0 animated" data-animate="fadeInUp" data-delay=".1"><img src="{{asset('assets/images/about-video-image.jpg')}}" alt="gfx"></div>
          </div><!-- .col -->
          <div class="col-lg-7">
            <!-- Section Head @s -->
            <div class="nk-block-text pdb-r">
              <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".1">{{$basic->about_title}} </h2>




              <p class="animated" data-animate="fadeInUp" data-delay=".2">{!! $basic->about !!}</p>
            </div><!-- .section-head @e -->
            <div class="row gutter-vr-20px flex-wrap">
              <div class="col-sm-6">
                <div class="feature feature-s1 animated" data-animate="fadeInUp" data-delay=".4">
                  <div class="feature-icon feature-icon-s5 feature-icon-s5-1"><em class="icon fas fa-key"></em></div>
                  <div class="feature-text feature-text-s1">
                    <p>Secure and fool proof crypto currency system</p>
                  </div>
                </div>
              </div><!-- .col -->
              <div class="col-sm-6">
                <div class="feature feature-s1 animated" data-animate="fadeInUp" data-delay=".4">
                  <div class="feature-icon feature-icon-s5 feature-icon-s5-2"><em class="icon fas fa-lock"></em></div>
                  <div class="feature-text feature-text-s1">
                    <p>Developed with the most secure algorithm</p>
                  </div>
                </div>
              </div><!-- .col -->
              <div class="col-sm-6">
                <div class="feature feature-s1 animated" data-animate="fadeInUp" data-delay=".5">
                  <div class="feature-icon feature-icon-s5 feature-icon-s5-3"><em class="icon fas fa-laptop"></em></div>
                  <div class="feature-text feature-text-s1">
                    <p>Premium user interface and excellent user experience</p>
                  </div>
                </div>
              </div><!-- .col -->
              <div class="col-sm-6">
                <div class="feature feature-s1 animated" data-animate="fadeInUp" data-delay=".6">
                  <div class="feature-icon feature-icon-s5 feature-icon-s5-4"><em class="icon fas fa-wallet"></em></div>
                  <div class="feature-text feature-text-s1">
                    <p>You manage your wallet with complete autonomy</p>
                  </div>
                </div>
              </div><!-- .col -->
            </div><!-- .row -->
          </div><!-- .col -->
        </div><!-- .row -->
      </div><!-- .block @e -->
    </div>
  </section><!-- // -->
  <!-- <section class="section bg-white" id="overview">
    <div class="container">
      <div class="nk-block nk-block-features-s2">
        <div class="row align-items-center gutter-vr-30px">
          <div class="col-lg-6">
            <div class="gfx py-4 mx-auto mx-lg-0 animated" data-animate="fadeInUp" data-delay=".1"><img src="{{asset('assets/images/vmg.jpg')}}" alt="gfx"></div>
          </div>
          <div class="col-lg-6">
            <div class="feature animated" data-animate="fadeInUp" data-delay=".2">
              <h2 class="title-xl-2 title-thin pdb-s">Vision</h2>
              <div class="feature-text feature-text-s1">
                <p>{{$basic->vision}}.</p>
              </div>
            </div>
            <div class="feature animated" data-animate="fadeInUp" data-delay=".3">
              <h2 class="title-xl-2 title-thin pdb-s">Mission</h2>
              <div class="feature-text feature-text-s1">
                <p>{{$basic->mission}}</p>
              </div>
            </div>
            <div class="feature animated" data-animate="fadeInUp" data-delay=".4">
              <h2 class="title-xl-2 title-thin pdb-s">Goal</h2>
              <div class="feature-text feature-text-s1">
                <p>{{$basic->goal}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <section class="section bg-light">
    <div class="container">
      <!-- Block @s -->
      <div class="nk-block nk-block-features-s3">
        <div class="section-head section-head-s7 wide-auto-sm text-center">
          <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".1">Why Choose {{$basic->sitename}}</h2>
        </div>
        <div class="row justify-content-center gutter-vr-30px">
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".3">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-globe"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Global Presence:</h4>
                <p class="fw-4">We have taken the best spot on the world cryptocurrency market.</p>
                </p>
              </div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".4">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-shiled-4"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Safe Transactions:</h4>
                <p class="fw-4">All transactions carried out on our platform us safe and secure.</p>
              </div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".5">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-wallet"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Multi Wallet System:</h4>
                <p class="fw-4">We support multiple crypto wallet and payment gateways</p>
              </div>
            </div>
          </div><!-- .col -->
        </div><!-- .row -->
      </div><!-- Block @e -->
      <div class="nk-block nk-block-features-s3">
        <div class="section-head section-head-s7 wide-auto-sm text-center">
          <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".1">What Makes {{$basic->sitename}} Different</h2>
        </div>
        <div class="row justify-content-center gutter-vr-30px">
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".3">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-cloud"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Global Single-Platform:</h4>
                <p class="fw-4">Cloud storage of your details, so no loss of crypto wallet.</p>
              </div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".4">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-safety"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Be Safe and Secure:</h4>
                <p class="fw-4">We guarantee a safe and reliable experience on {{$basic->sitename}}.</p>
              </div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-4 col-md-6">
            <div class="feature feature-s3 feature-center animated" data-animate="fadeInUp" data-delay=".5">
              <div class="feature-icon feature-icon-auto"><em class="icon icon-grd icon-lg ikon ikon-cash"></em></div>
              <div class="feature-text">
                <h4 class="title-sm title-semibold">Decentralize Payment Systems</h4>
                <p class="fw-4">We made sure all payment is made easy and autonomous for you.</p>
              </div>
            </div>
          </div><!-- .col -->
        </div><!-- .row -->
      </div><!-- .block @e -->
    </div>
  </section><!-- // -->

  <section lass="section bg-theme ov-h text-center tc-light" style="background-color: white;">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-5 mgb-r">
          <h3 class="title title title-md">Supported Cryptocurrencies</h3>
          <p>Our list of supported cryptocurrencies</p>
          <table class="table">
            <tbody>

              @foreach($currency as $key => $data)
              <tr>
                <td class="table-head">{{$data->name}}</td>
                <td class="table-des">{{number_format($data->price, $basic->decimal)}} USD</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="col-lg-5">
          <h3 class="title title title-md">{{$basic->sitename}} Trade Rate</h3>
          <p>Coin Exchange Price + {{$basic->sitename}} Charge</p>
          <table class="table table-bordered">
            <tbody>
              <tr><b>
                  <td class="table-head">Coins</td>
                  <td class="table-head">We Buy At</td>
                  <td class="table-head">We Sell At</td>
                </b></tr>
              @foreach($currency as $key => $data)
              <tr>
                <td class="table-head">{{$data->name}}</td>
                <td class="table-des">{{number_format($data->sell, $basic->decimal)}} {{$basic->currency}}</td>
                <td class="table-des">{{number_format($data->buy, $basic->decimal)}} USD</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>


  <section class="section bg-theme ov-h text-center tc-light" style="background-color: #024C5D !important;">
    <div class="container">
      <div class="section-head text-center animated" data-animate="fadeInUp" data-delay=".1">
        <h2 class="title">What Our Customers Say</h2>
        <p class="lead lead-regular lead-s2">See what our customer say about {{$basic->sitename}}</p>
      </div>
      <div class="nk-block nk-block-testimonial">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="testimonial-carousel has-carousel owl-carousel animated" data-animate="fadeInUp" data-delay=".2" data-items="1" data-navs="true" data-loop="true">

              @foreach($testimonial as $data)
              <div class="testimonial card">
                <div class="tesm-image">
                  @if($data->user_id > 1)
                  @if( file_exists($data->user->image))
                  <img src="{{asset($data->user->image)}} " width="100" alt="Profile Pic">
                  @else
                  <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">
                  @endif
                  @else
                  <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">

                  @endif

                </div>
                <div class="tesm-content">
                  <p>{{$data->details}}</p>
                  <h4 class="title title-sm">
                    @if($data->user_id < 2) Administrator @else {{$data->user->fname}} {{$data->user->lname}} @endif <span>

                      @if($data->user_id < 2) Admin @else {{$data->user->username}} @endif </span>
                  </h4>
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section bg-light">
    <div class="container">
      <!-- Block @s -->
      <div class="nk-block nk-block-features-s2">
        <div class="row align-items-center flex-row-reverse justify-content-between gutter-vr-30px">
          <div class="col-lg-7">
            <div class="gfx gfx-auto mb-lg-3 animated" data-animate="fadeInUp" data-delay=".1"><img src="{{asset('front-assets/images/map2.png')}}" alt="gfx"></div>
          </div><!-- .col -->
          <div class="col-lg-4">
            <!-- Section Head @s -->
            <div class="section-head pb-lg-0">
              <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".2">{{$basic->sitename}} Is Global</h2>
              <p class=" animated" data-animate="fadeInUp" data-delay=".3">We cut across continents and our customers' service agents are online 24/7 to take your requests, complaints and order just to serve you better. We ensure that you experience the very best of cryptocurrency trade on {{$basic->sitename}} anywhere you are in the world</p>
            </div><!-- .section-head @e -->
          </div><!-- .col -->
        </div><!-- .row -->
        <div class="row features-list flex-wrap gutter-vr-30px">
          <div class="col-lg-3 col-sm-6">
            <div class="feature feature-s1 feature-s1-1 boxed boxed-xs bg-white bordered animated" data-animate="fadeInUp" data-delay=".4">
              <div class="feature-icon feature-icon-s5 feature-icon-s5-1"><em class="icon fas fa-lock"></em></div>
              <div class="feature-text feature-text-s1"><span class="title-xs-alt title-mid">Safe &amp; Secure Transactions</span></div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-3 col-sm-6">
            <div class="feature feature-s1 feature-s1-2 boxed boxed-xs bg-white bordered animated" data-animate="fadeInUp" data-delay=".5">
              <div class="feature-icon feature-icon-s5 feature-icon-s5-2"><em class="icon fas fa-key"></em></div>
              <div class="feature-text feature-text-s1"><span class="title-xs-alt title-mid">Encrypted and Kept Private</span></div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-3 col-sm-6">
            <div class="feature feature-s1 feature-s1-3 boxed boxed-xs bg-white bordered animated" data-animate="fadeInUp" data-delay=".6">
              <div class="feature-icon feature-icon-s5 feature-icon-s5-3"><em class="icon fas fa-credit-card"></em></div>
              <div class="feature-text feature-text-s1"><span class="title-xs-alt title-mid">Multiple Payment Gateway</span></div>
            </div>
          </div><!-- .col -->
          <div class="col-lg-3 col-sm-6">
            <div class="feature feature-s1 feature-s1-4 boxed boxed-xs bg-white bordered animated" data-animate="fadeInUp" data-delay=".7">
              <div class="feature-icon feature-icon-s5 feature-icon-s5-4"><em class="icon fas fa-user"></em></div>
              <div class="feature-text feature-text-s1"><span class="title-xs-alt title-mid">KYC Verification</span></div>
            </div>
          </div><!-- .col -->
        </div><!-- .row -->
      </div><!-- .block @e -->
    </div>
  </section><!-- // -->
  <!-- .block @s -->

  <section class="section bg-light-alt" id="faq">
    <div class="container">
      <div class="row justify-content-between gutter-vr-30px">
        <div class="col-lg-4">
          <div class="section-head section-head-s7 wide-auto-sm text-lg-left text-center">
            <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".1">FAQs</h2>
            <p class="lead animated" data-animate="fadeInUp" data-delay=".2">Below we’ve provided a bit of {{$basic->sitename}} customers' common questions & answers. If you have any other questions, please get in touch via email.</p>
          </div>
        </div><!-- .col -->
        <div class="col-lg-7">
          <div class="accordion animated" data-animate="fadeInUp" data-delay=".3" id="faq-36">


            @foreach($faq as $data)
            <div class="accordion-item accordion-item-s3">
              <h5 class="accordion-title accordion-title-sm" data-toggle="collapse" data-target="#faq-36-{{$data->id}}">{{$data->title}} <span class="accordion-icon accordion-icon-s1"></span></h5>
              <div id="faq-36-{{$data->id}}" class="collapse showd" data-parent="#faq-36">
                <div class="accordion-content">
                  <p>{!! $data->description !!}</p>
                </div>
              </div>
            </div>
            @endforeach


          </div>
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container -->
  </section><!-- // -->


  <section class="section section-contact bg-white" id="contact">
    <div class="container">
      <!-- Block @s -->
      <div class="nk-block block-contact">
        <div class="row justify-content-between gutter-vr-30px">
          <div class="col-lg-4">
            <div class="section-head section-head-sm section-head-s7 wide-auto-sm text-lg-left text-center">
              <h2 class="title title-thin animated" data-animate="fadeInUp" data-delay=".1">Get In Touch</h2>
              <p class="lead animated" data-animate="fadeInUp" data-delay=".2">Any question? Reach out to us and we’ll get back to you shortly</p>
            </div>
            <ul class="contact-list contact-list-s2 gutter-30px">
              <li class="animated" data-animate="fadeInUp" data-delay=".3"><em class="contact-icon fas fa-phone"></em>
                <div class="contact-text"><span>{{$basic->phone}}</span></div>
              </li>
              <li class="animated" data-animate="fadeInUp" data-delay=".4"><em class="contact-icon fas fa-envelope"></em>
                <div class="contact-text"><span>{{$basic->email}}</span></div>
              </li>
              <li class="animated" data-animate="fadeInUp" data-delay=".5"><em class="contact-icon fas fa-map"></em>
                <div class="contact-text"><span>{{$basic->address}}</span></div>
              </li>
            </ul>
          </div><!-- .col -->
          <div class="col-lg-7">
            <div class="bg-light round animated" data-animate="fadeInUp" data-delay=".6">
              <form class="contact-form contact-form-s2 boxed boxed-md  " action="{{route('contact.submit')}}" method="post">
                {!! csrf_field() !!}

                <div class="field-item field-item-s2"><input type="text" class="input-bordered input-bordered-lg input-bordered-light required" name="name" placeholder="Your Name"></div>

                <div class="field-item field-item-s2"><input name="phone" type="text" class="input-bordered input-bordered-lg  input-bordered-light required" placeholder="Your Phone"></div>

                <div class="field-item field-item-s2"><input name="email" type="text" class="input-bordered input-bordered-lg  input-bordered-light required" placeholder="Your Email"></div>

                <div class="field-item field-item-s2"><input name="subject" type="text" class="input-bordered input-bordered-lg  input-bordered-light required" placeholder="Your Subject"></div>

                <div class="field-item field-item-s2"><textarea name="message" class="input-bordered input-bordered-lg input-bordered-light input-textarea required" placeholder="Your Message"></textarea></div><input type="text" class="d-none" name="form-anti-honeypot" value="">
                <div class="row">
                  <div class="col-sm-12"><button type="submit" class="btn btn-md btn-primary">Submit</button></div>
                  <div class="col-sm-12">
                    <div class="form-results"></div>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- .col -->
        </div><!-- .row -->
      </div><!-- .block @e -->
    </div>
  </section><!-- // -->



  <section class="section section-s bg-light">
    <div class="container">
      <!-- Block @s -->
      <div class="nk-block block-partners">
        <div class="section-head section-head-sm">
          <h6 class="title-md title-thin text-center animated" data-animate="fadeInUp" data-delay=".1">Payment Gateways</h6>
        </div>
        <ul class="partner-list flex-lg-nowrap mgb-m30">
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".15"><img src="{{asset('front-assets/images/paystac.png')}}" alt="partner"></li>
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".2">

            <img src="{{asset('front-assets/images/stripe.png')}}" alt="partner">
          </li>
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".25">
            <img src="{{asset('front-assets/images/pay-c.png')}}" alt="partner">
          </li>
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".3">
            <img src="{{asset('front-assets/images/pay-b.png')}}" alt="partner">
          </li>
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".35">
            <img src="{{asset('front-assets/images/pay-a.png')}}" alt="partner">
          </li>
          <li class="partner-logo-s3 animated" data-animate="fadeInUp" data-delay=".4">
            <img src="{{asset('front-assets/images/flutter.png')}}" alt="partner">
          </li>
        </ul>
      </div><!-- Block @e -->
    </div>
  </section>
</main>

@endsection