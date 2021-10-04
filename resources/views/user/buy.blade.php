@extends('include.userdashboard')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="main-content col-lg-12">
                <div class="content-area card">
                    <div class="card-innr">
                        <div class="card-head">
                            <h4 class="card-title">Buy Cryptocurrency</h4>
                        </div>
                        <div class="card-text">
                            <p>Please select any of the following e-currency to continue your purchase.</p>
                        </div>
                        <div class="token-currency-choose">
                            <div class="row guttar-15px">
                                @foreach($currency as $data)
                                <!-- {{$data}} -->
                                <div class="col-6 a1" data-coin="{{$data->id}}" data-sym="{{$data->symbol}}" data-id="{{$data->name}}" data-rate="{{$data->buy}}">
                                    <div class="pay-option">
                                        <input class="pay-option-check" type="radio" data-id="{{$data->id}}" name="currency_id">
                                        <label class="pay-option-label" for="{{$data->id}}"><span class="pay-title">
                                                <em class="pay-icon cf cf-@if($data->icon =='paypal')pivx @else{{$data->icon}}@endif"></em>
                                                <span class="pay-cur">{{$data->symbol}}</span></span>
                                            <span class="pay-amount">{{$basic->currency_sym}}{{number_format($data->sell, $basic->decimal)}}</span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                                <script>
                                    function myFunction() {
                                        var usd = $('#usd').val();
                                        var local = $('#local').val();
                                        var price = $("#mySelect option:selected").attr('data-price');
                                        var coin = $("#mySelect option:selected").attr('data-coin');
                                        var name = $("#mySelect option:selected").attr('data-name');
                                        var sell = $("#mySelect option:selected").attr('data-sell');
                                        var cur = $("#mySelect option:selected").attr('data-cur');
                                        var rate = usd * sell;
                                        document.getElementById("local").value = "{{$basic->currency_sym}}" + rate;
                                        document.getElementById("sell").innerHTML = sell;
                                        document.getElementById("name").innerHTML = name;
                                        document.getElementById("currency").innerHTML = name;
                                        document.getElementById("currency2").innerHTML = name;
                                        document.getElementById("currency3").innerHTML = name;
                                        document.getElementById("cur").innerHTML = cur;

                                        if (cur == 0) {
                                            document.getElementById("show").innerHTML = "<div class='note note-plane note-danger'><em class='fas fa-info-circle'></em><p>Please select a crypto currency to proceed with purchase</p></div>";
                                        } else {
                                            document.getElementById("show").innerHTML = "<a href='#' data-toggle='modal' data-target='#pay-confirm' class='btn btn-outline btn-secondary btn-md'>Proceed &nbsp; <em class='ti ti-shopping-cart'></em></a>";
                                        }

                                    };
                                </script>






                            </div><!-- .row -->
                        </div>



                        <div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Select E-Currency</label>
                            <div class="relative"><span class="input-icon input-icon-right">{{$basic->currency}}</span>
                                <select required class="select-bordered select-block" id="mySelect" onchange="myFunction()" name="method_id">
                                    <option data-cur="0" selected>Choose...</option>
                                    @foreach($currency as $data)
                                    <option data-coin="{{$data->symbol}}" data-cur="{{$data->id}}" data-sell="{{$data->sell}}" data-name="{{$data->name}}" data-address="{{App\Cryptowallet::whereCoin_id($data->id)->first()->address}}" data-price="{{$data->price}}" value="{{$data->id}}">{{$data->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a id="show"></a>

                        <div class="card-head"><span class="card-sub-title text-primary font-mid"><br><br>Please Note Your transaction will be calculated at the current market price of the intended coin</span></div>
                        <!-- .container -->
                    </div><!-- .container -->
                </div><!-- .page-content -->






                <!-- Modal End -->


                <div class="modal fade" id="pay-confirm" tabindex="-1">
                    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
                        <div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                            <div class="popup-body">
                                <h4 class="popup-title">Buy <a id="name"> <a /></h4>
                                <p class="lead text-primary">1USD = {{$basic->currency_sym}}<a id="sell"></a> </p>



                                <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                                    <p>The purchased <a id="name"></a> will appear in your <a id="currency2"></a> account only after you transaction has been confirmed and approved on our server..</p>
                                </div>
                                <div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
                                    <p>Ensure you enter a <strong>valid <a id="name1"></a> wallet address</strong> {{$basic->sitename}} will not be liable for any loss arising from you entering a wrong {{$data->name}} wallet address.</p>
                                </div>
                                <br>
                                <form method="POST" action="{{ route('buyecoin') }}">
                                    @csrf
                                    <div class="row">
                                        <textarea row="1" name="coin" required hidden class="input-bordered" type="text" id="cur"></textarea>
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount In USD</label><input id="usd" onkeyup="myFunction()" name="usd" placeholder="$0.00" class="input-bordered" type="text"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount In {{$basic->currency}}</label><input placeholder="{{$basic->currency_sym}}0.00" id="local" onkeyup="myFunction()" class="input-bordered" name="local" type="text"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label"><label class="input-item-label text-exlight"><a id="currency"></a> Wallet Address</label><input placeholder="E.G: 0xde0b295669a9fd93d5f28d9ec85e40f4cb697bae" name="wallet" class="input-bordered" type="text"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item input-with-label"><label class="input-item-label text-exlight">Confirm <a id="currency3"></a> Address</label><input name="rewallet" placeholder="" class="input-bordered" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-item input-with-label">
                                                <label class="input-item-label text-exlight">Select Payment Method</label>
                                                <select required onchange="showDiv('div',this)" class="select-bordered select-block" id="" name="payment">
                                                    <option value="1" selected>Choose...</option>
                                                    <option value="2">Bank Transfer </option>
                                                    <option value="3">Online Payment </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="div1" style="display:block;">

                                    </div>
                                    <div id="div2" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label"><label class="input-item-label text-exlight">Payment Method</label>
                                                    <select required class="select-bordered select-block" id="mySelect" onchange="myFunction()" name="method">
                                                        <option selected>Choose...</option>
                                                        @foreach($method as $data)
                                                        <option value="{{$data->id}}">{{$data->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-item input-with-label"><label class="input-item-label text-exlight">Select Bank</label><select required class="select-bordered select-block" name="bank">
                                                        <option selected>Choose...</option>
                                                        @foreach($bank as $data)
                                                        <option value="{{$data->id}}">{{$data->name}} </option>
                                                        @endforeach
                                                    </select></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div3" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-item input-with-label"><label class="input-item-label text-exlight">Select Payment Gateway</label>

                                                    <select required class="select-bordered select-block" name="gateway">
                                                        <option selected>Choose...</option>
                                                        @foreach($gates as $data)
                                                        <option value="{{$data->id}}">{{$data->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                    <script>
                                        // function showDiv() {
                                        //     var strUser = numberToSelect.value;
                                        //     console.log(strUser)
                                        // }

                                        function showDiv(prefix, chooser) {
                                            console.log(prefix)
                                            console.log(chooser)
                                            for (var i = 0; i < chooser.options.length; i++) {
                                                var div = document.getElementById(prefix + chooser.options[i].value);
                                                div.style.display = 'none';
                                            }

                                            var selectedOption = (chooser.options[chooser.selectedIndex].value);
                                            if (selectedOption == "1") {
                                                displayDiv(prefix, "1");
                                            }
                                            if (selectedOption == "2") {
                                                displayDiv(prefix, "2");
                                            }
                                            if (selectedOption == "3") {
                                                displayDiv(prefix, "3");
                                            }
                                        }

                                        function displayDiv(prefix, suffix) {
                                            var div = document.getElementById(prefix + suffix);
                                            div.style.display = 'block';
                                        }
                                    </script>
                                    <div class="input-item input-with-label"><label for="token-address" class="input-item-label text-exlight">Comment/Instruction</label><textarea row="3" class="input-bordered" name="comment" type="text"></textarea></div><!-- .input-item -->
                                    <ul class="d-flex flex-wrap align-items-center guttar-30px">
                                        <li><button type="submit" class="btn btn-primary btn-outline">Buy</button>
                                </form>
                                </li>
                                </ul>
                                <div class="gaps-2x"></div>
                                <div class="gaps-1x d-none d-sm-block"></div>
                            </div>
                        </div><!-- .modal-content -->
                    </div><!-- .modal-dialog -->
                </div><!-- Modal End -->






                @endsection