@extends('include.userdashboard')
@section('content')
  <div class="page-content"><div class="container"><div class="row">
  <div class="col-lg-12"><div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Pay Using Stripe</h6></div><div class="gaps-1x"></div><!-- .gaps -->

<form role="form" id="payment-form" method="POST" action="{{ route('ipn.stripe')}}">
                  @csrf


<div class="row"><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Card Owner's Name</label>
 <input type="text" class="input-bordered" name="name" placeholder="Card Name" autocomplete="off" autofocus/>
<span class="input-note">Please enter name as written on card</span></div></div><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Card Number</label><input type="tel" class="input-bordered"  name="cardNumber" placeholder="Valid Card Number" autocomplete="off"
                                               required autofocus/><span class="input-note">Your card details are processed directly by stripe</span></div></div></div><div class="row"><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Card Pin</label><div class="relative"><span class="input-icon input-icon-right"><em class="ti ti-mobile"></em></span><input  type="tel" class="input-bordered"  name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required  />

                                               </div><span class="input-note">Input your card expiry date. </span></div></div><div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">CCV</label> <input type="tel" class="input-bordered" name="cardCVC"  placeholder="CVC"  autocomplete="off" required /><span class="input-note">Check behind card for code </span></div></div></div>

<div class="gaps-1x"></div><button class="btn btn-primary" type="submit" btn-primary">Submit</button></form></div><!-- .card-innr --></div><!-- .card --></div><!-- .card-innr --></div><!-- .card --></div></div></div><!-- .container --></div>
@stop

@section('script')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@stop


