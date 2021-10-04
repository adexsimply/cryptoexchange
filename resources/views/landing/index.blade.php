@extends('include.landing-page')
@section('content')

<!--begin home section -->
<section class="home-section" id="home">

    <!--begin container -->
    <div class="container">

        <!--begin row -->
        <div class="row align-items-center">

            <!--begin col-md-6-->
            <div class="col-md-6">

                <h1>Welcome to PM247Crypto.<i class=""></i></h1>

                <p class="hero-text">Your search-stop site for best rates on Perfect Money, BTC, USDT and ETH.</p>

                <a href="{{route('buy')}}" class="scrool"><button type="button" class="btn btn-lg btn-primary">Buy Coin</button></a>
                <a href="{{route('sell')}}" class="scrool"><button type="button" class="btn btn-lg btn-primary">Sell Coin</button></a>

                <!--begin newsletter_form_box -->
                <div class="newsletter_form_box">

                    <!--begin success_box -->
                    <p class="newsletter_success_box" style="display:none;">We received your message and you'll hear from us
                        soon. Thank You!</p>

                    <p class="newsletter-form-terms">
                        <span><i class=""></i> JOIN OUR COMMUNITY</span>
                    <div>
                        <ul class="team-icon">

                            <li><a href="#" class="twitter"><i class="bi bi-twitter"></i></a></li>

                            <li><a href="#" class="pinterest"><i class="bi bi-instagram"></i></a></li>

                            <li><a href="#" class="facebook"><i class="bi bi-mic"></i></a></li>

                            <li><a href="#" class="dribble"><i class="bi bi-envelope-open"></i></a></li>

                        </ul>
                    </div>



                </div>
                <!--end newsletter_form_box -->

            </div>
            <!--end col-md-6-->

            <!--begin col-md-5-->
            <div class="col-md-6">

                <img src="{{asset('assets/landing/images/phone.png') }}" class="hero-image width-100 margin-top-20" alt="pic">

            </div>
            <!--end col-md-5-->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</section>

<!--begin section-white -->
<section class="section-white">
    <!--begin container-->
    <div class="container">

        <!--begin row-->
        <div class="row align-items-center">

            <!--begin col-md-6-->
            <div class="col-md-6">

                <h3>About us.</h3>

                <p>Pm247crypto.com is the exchange arm of Mercurial Services & Capital Investment Ltd. The venture was borne
                    out of the need for reliable Exchanger where users can buy and sell Perfect Money (PM), BTC, USDT and ETH
                    flawlessly; without the prevailing distrust associated with social media transactions. We assure you of
                    unparalleled top-notch transaction experience on this platform, with instant crediting within 15 minutes
                    after payment confirmation. As the Company progresses, the transaction turn-around-time (TAT) shall become
                    zero; fully automated.</p>

                <ul class="benefits">
                    <li><i class="bi bi-check blue"></i>Secure and fool proof crypto currency system.</li>
                    <li><i class="bi bi-check blue"></i>Developed with the most secure algorithm.</li>
                    <li><i class="bi bi-check blue"></i>Premium user interface and excellent user experience.</li>
                    <li><i class="bi bi-check blue"></i>You manage your wallet with complete autonomy</li>
                </ul>

                <a href="https://www.pm247crypto.com/register" class="scrool"><button type="button" class="btn btn-lg btn-primary">Order Now</button></a>

            </div>
            <!--end col-md-6-->

            <!--begin col-md-6-->
            <div class="col-md-6">

                <img src="{{asset('assets/landing/s/p247.png') }}" lass="width-100 responsive-top-margins" alt="pic">

            </div>
            <!--end col-sm-6-->

        </div>
        <!--end row-->

    </div>
</section>

<!--begin section-white -->
<section class="section-white" id="about">

    <!--begin container -->
    <div class="container">

        <!--begin row -->
        <div class="row">

            <!--begin col-md-12 -->
            <div class="col-md-12 text-center">

                <h2>Why Choose PM247Crypto</h2>

            </div>
            <!--end col-md-12 -->

            <!--begin col-md-4 -->
            <div class="col-md-4">

                <div class="main-services">

                    <i class="bi bi-megaphone green"></i>

                    <h4>Global Presence</h4>

                    <p>We have taken the best spot on the world cryptocurrency market.</p>

                </div>

            </div>
            <!--end col-md-4 -->

            <!--begin col-md-4 -->
            <div class="col-md-4">

                <div class="main-services">

                    <i class="bi bi-gem red"></i>

                    <h4>Safe Transactions</h4>

                    <p>All transactions carried out on our platform us safe and secures.</p>

                </div>

            </div>
            <!--end col-md-4 -->

            <!--begin col-md-4 -->
            <div class="col-md-4">

                <div class="main-services">

                    <i class="bi bi-speedometer2 blue"></i>

                    <h4>Decentralize Payment Systems</h4>

                    <p>We made sure all payment is made easy and autonomous for you.</p>

                </div>

            </div>
            <!--end col-md-4 -->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</section>
<!--end section-white -->

<!--begin testimonials section -->
<section class="section-grey small-padding-bottom">

    <!--begin container -->
    <div class="container" style="overflow: hidden">

        <!--begin row -->
        <div class="row">

            <!--begin col md 12 -->
            <div class="col-md-12 mx-auto padding-top-10 padding-bottom-30">
                <div class="col-md-12 text-center">

                    <h2>What Our Customers Say</h2>

                </div>

                <!--begin testimonials carousel -->
                <div id="carouselTestimonials" class="carousel slide" data-bs-ride="carousel">

                    <!--begin carousel-indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <!--end carousel-indicators -->

                    <!--begin carousel-inner -->
                    <div class="carousel-inner">

                        <!--begin carousel-item -->
                        <div class="carousel-item active">

                            <!--begin row -->
                            <div class="row align-items-center testim-inner">

                                <!--begin col-md-6 -->
                                <div class="col-md-6">

                                    <!--begin video-popup-wrapper-->
                                    <div class="video-popup-wrapper margin-right-25">

                                        <!--begin popup-gallery-->
                                        <div class="popup-gallery">

                                            <img src="http://placehold.it/555x365" alt="testimonials" class="width-100 image-shadow video-popup-image responsive-bottom-margins">

                                            <a class="popup4 video-play-icon" href="https://www.youtube.com/watch?v=FPfQMVf4vwQ">
                                                <i class="bi bi-caret-right-fill"></i>
                                            </a>

                                        </div>
                                        <!--end popup-gallery-->

                                    </div>
                                    <!--end video-popup-wrapper-->

                                </div>
                                <!--end col-md-6 -->

                                <!--begin col-md-6 -->
                                <div class="col-md-6 testim-info">

                                    <i class="bi bi-chat-left-quote green"></i>

                                    <p>Nemo enimat ipsam voluptatem quia voluptas situm ets aspernatis netsum loris fugit, sed quia
                                        magnitus honoratis quis ratione sequi etum nets.</p>

                                    <h6>Jennifer Smith<span> — Designer <span class="red">@EpicThemes</span></span></h6>

                                </div>
                                <!--end col-md-5 -->

                            </div>
                            <!--end row -->

                        </div>
                        <!--end carousel-item -->

                        <!--begin carousel-item -->
                        <div class="carousel-item">

                            <!--begin row -->
                            <div class="row align-items-center testim-inner">

                                <!--begin col-md-6 -->
                                <div class="col-md-6">

                                    <!--begin video-popup-wrapper-->
                                    <div class="video-popup-wrapper margin-right-25">

                                        <!--begin popup-gallery-->
                                        <div class="popup-gallery">

                                            <img src="http://placehold.it/555x365" alt="testimonials" class="width-100 image-shadow video-popup-image responsive-bottom-margins">

                                            <a class="popup4 video-play-icon" href="https://www.youtube.com/watch?v=FPfQMVf4vwQ">
                                                <i class="bi bi-caret-right-fill"></i>
                                            </a>

                                        </div>
                                        <!--end popup-gallery-->

                                    </div>
                                    <!--end video-popup-wrapper-->

                                </div>
                                <!--end col-md-6 -->

                                <!--begin col-md-6 -->
                                <div class="col-md-6 testim-info">

                                    <i class="bi bi-chat-left-quote green"></i>

                                    <p>Nemo enimat ipsam voluptatem quia voluptas situm ets aspernatis netsum loris fugit, sed quia
                                        magnitus honoratis quis ratione sequi etum nets.</p>

                                    <h6>John Doe<span> — General Manager <span class="red">@Bepm247crypto.com</span></span></h6>

                                </div>
                                <!--end col-md-5 -->

                            </div>
                            <!--end row -->

                        </div>
                        <!--end carousel-item -->

                        <!--begin carousel-item -->
                        <div class="carousel-item">

                            <!--begin row -->
                            <div class="row align-items-center testim-inner">

                                <!--begin col-md-6 -->
                                <div class="col-md-6">

                                    <!--begin video-popup-wrapper-->
                                    <div class="video-popup-wrapper margin-right-25">

                                        <!--begin popup-gallery-->
                                        <div class="popup-gallery">

                                            <img src="http://placehold.it/555x365" alt="testimonials" class="width-100 image-shadow video-popup-image responsive-bottom-margins">

                                            <a class="popup4 video-play-icon" href="https://www.youtube.com/watch?v=FPfQMVf4vwQ">
                                                <i class="bi bi-caret-right-fill"></i>
                                            </a>

                                        </div>
                                        <!--end popup-gallery-->

                                    </div>
                                    <!--end video-popup-wrapper-->

                                </div>
                                <!--end col-md-6 -->

                                <!--begin col-md-6 -->
                                <div class="col-md-6 testim-info">

                                    <i class="bi bi-chat-left-quote green"></i>

                                    <p>Nemo enimat ipsam voluptatem quia voluptas situm ets aspernatis netsum loris fugit, sed quia
                                        magnitus honoratis quis ratione sequi etum nets.</p>

                                    <h6>Emily Richards<span> — Copywriter <span class="red">@Books-Online</span></span></h6>

                                </div>
                                <!--end col-md-5 -->

                            </div>
                            <!--end row -->

                        </div>
                        <!--end carousel-item -->

                    </div>
                    <!--end carousel-inner -->

                </div>
                <!--end testimonials carousel -->

            </div>
            <!--end col md 12-->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</section>

<section class="section-white" id="contact">

    <!--begin container-->
    <div class="container">

        <!--begin row-->
        <div class="row">

            <!--begin col-md-6 -->
            <div class="col-md-6">

                <h3>Supported Cryptocurrencies</h3>

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

                <!--begin contact form -->
                <!-- <form id="contact-form" class="contact" action="php/contact.php" method="post">

                            <input class="contact-input white-input" required="" name="contact_names" placeholder="Full Name*" type="text">

                            <input class="contact-input white-input" required="" name="contact_email" placeholder="Email Adress*" type="email">

                            <input class="contact-input white-input" required="" name="contact_phone" placeholder="Phone Number*" type="text">

                            <textarea class="contact-commnent white-input" rows="2" cols="20" name="contact_message" placeholder="Your Message..."></textarea>

                            <input value="Send Message" id="submit-button" class="contact-submit" type="submit">

                        </form> -->
                <!--end contact form -->

            </div>
            <!--end col-md-6 -->

            <!--begin col-md-6 -->
            <div class="col-md-6 responsive-top-margins">
                <h3>PM247Crypto Trade Rate</h3>

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
            <!--end row-->

        </div>
        <!--end container-->

</section>
<!--end contact-->

<section class="section-grey" id="how-it-works">

    <!--begin container -->
    <div class="container">

        <!--begin row -->
        <div class="row align-items-center">

            <!--begin col-md-5 -->
            <div class="col-md-5 col-sm-12">

                <h2>Frequently Asked Questions.</h2>

                <p>Below we’ve provided a bit of PM247Crypto customers' common questions & answers. If you have any other
                    questions, please get in touch via email.</p>


            </div>
            <!--end col-md-5 -->

            <!--begin col-md-1 -->
            <div class="col-md-1"></div>
            <!--end col-md-1 -->

            <!--begin col-md-6-->
            <div class="col-md-6">

                <!--begin accordion -->
                <div class="accordion accordion-flush" id="accordionOne">

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="headingOne">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="bi bi-pencil-fill"></i> Is registration required on this site?
                            </button>

                        </h2>

                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionOne">

                            <div class="accordion-body">
                                Yes; you need to register on the site and get verified to use any of our services. This is in
                                attempt to protect you (users) and the Company against fraud.
                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="headingTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-bar-chart-line-fill"></i> How does this platform works?
                            </button>

                        </h2>

                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionOne">

                            <div class="accordion-body">
                                You need to register on this platform, by clicking on the “Sign Up/Register” icon. Then, get the
                                account verified to buy or sell any of the E-currencies.
                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="headingThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-hand-thumbs-up-fill"></i> What type of ID or proof of Address do you accept for
                                verification?
                            </button>

                        </h2>

                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionOne">

                            <div class="accordion-body">
                                For proof of Identity, we accept active/valid International passport, NIN (National Identity Number)
                                or Driver’s license. Meanwhile, Bank statement (in User’s name), Water bill or Electricity bill is
                                acceptable for Proof of Address verification.
                            </div>

                        </div>

                    </div>
                    <div class="accordion-item">

                        <h2 class="accordion-header" id="headingFour">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-hand-thumbs-up-fill"></i> How long does verification takes?
                            </button>

                        </h2>

                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionOne">

                            <div class="accordion-body">
                                Provided that a User uploaded clear verifiable documents, it takes not more than 48hrs for approval.
                            </div>

                        </div>

                    </div>
                    <div class="accordion-item">

                        <h2 class="accordion-header" id="headingFive">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-hand-thumbs-up-fill"></i> What is the minimum and maximum amount that can be
                                transacted on this Platform?
                            </button>

                        </h2>

                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionOne">

                            <div class="accordion-body">
                                Our minimum transaction amount is $20 or its equivalent, while the maximum daily transaction is
                                $5,000 per individual.
                            </div>

                        </div>

                    </div>


                </div>
                <!--end accordion -->

            </div>
            <!--end col-md-6-->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</section>

<!--begin contact -->
<section class="section-white" id="contact">

    <!--begin container-->
    <div class="container">

        <!--begin row-->
        <div class="row">

            <!--begin col-md-6 -->
            <div class="col-md-6">

                <h3>Get in touch</h3>

                <!--begin success message -->
                <p class="contact_success_box" style="display:none;">We received your message and you'll hear from us soon.
                    Thank You!</p>
                <!--end success message -->

                <!--begin contact form -->
                <form id="contact-form" class="contact" action="php/contact.php" method="post">

                    <input class="contact-input white-input" required="" name="contact_names" placeholder="Full Name*" type="text">

                    <input class="contact-input white-input" required="" name="contact_email" placeholder="Email Adress*" type="email">

                    <input class="contact-input white-input" required="" name="contact_phone" placeholder="Phone Number*" type="text">

                    <textarea class="contact-commnent white-input" rows="2" cols="20" name="contact_message" placeholder="Your Message..."></textarea>

                    <input value="Send Message" id="submit-button" class="contact-submit" type="submit">

                </form>
                <!--end contact form -->

            </div>
            <!--end col-md-6 -->

            <!--begin col-md-6 -->
            <div class="col-md-6 responsive-top-margins">

                <h3>Where we are</h3>

                <!--iframe class="contact-maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.9050207912896!2d-0.14675028449633118!3d51.514958479636384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ad554c335c1%3A0xda2164b934c67c1a!2sOxford+St%2C+London%2C+UK!5e0!3m2!1sen!2sro!4v1485889312335" width="600" height="270" style="border:0" allowfullscreen></iframe>-->
                <iframe class="contact-maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.3603903780827!2d3.2777226140939404!3d6.475954825512534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b88ca2790afa3%3A0x9c3c193a30feb4b4!2s4th%20Ave%2C%20Festac%20Town%20102102%2C%20Lagos!5e0!3m2!1sen!2sng!4v1630784046565!5m2!1sen!2sng" width="600" height="270" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


                <h5>Head Office</h5>

                <p class="contact-info"><i class="bi bi-geo-alt-fill"></i> Suites 11 & 12, Cometstar Plaza, 4th Avenue,
                    Festac Town. Lagos State. Nigeria</p>

                <p class="contact-info"><i class="bi bi-envelope-open-fill"></i> <a href="mailto:contact@youremail.com">
                        info@PM247Crypto.com</a></p>

                <p class="contact-info"><i class="bi bi-telephone-fill"></i> +234 708 489 5638</p>


            </div>

            <!--end col-md-6 -->

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</section>
<!--end contact-->
@endsection