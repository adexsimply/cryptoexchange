@extends('include.userdashboard')

@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="main-content col-lg-12">
                <div class="content-area card">
                    <div class="card-innr">
                        <h4>Please read before you pay into our {{$data->currency->name}} address</h4>
                        <ul class='list-group text-secondary'>
                            <li class='notice list-group-item'>
                                Do not pay below {{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} ).
                            </li>

                            <li class="notice list-group-item">
                                {{$basic->sitename}} will not be responsible for funding a wrong account number provided by you
                            </li>

                        </ul>
                    </div>
                    <div class="content-area card">
                        <div class="card-innr">
                            <div class="card-head"></div>
                            <center>
                                <h5 class="card-title card-title-md">Order details ({{$data->currency->name}})</h5>
                                @if($data->currency->id != 11)<img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$data->currency->payment_id}}&choe=UTF-8\" style=' width:100px;' />
                                @else
                                Perfect Money Account: {{$data->currency->payment_id}}

                                @endif

                                <br>
                                <span class="dt-type-md badge badge-outline badge-info badge-sm"><i class="fa fa-spinner fa-spin"></i>&nbsp;Awaiting</span>
                            </center>


                            @if($data->currency->id != 11)
                            <div class="card-text">
                                <p>Please pay <strong>{{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} )</strong> to the wallet address below or scan the wallet QR Code above to initiate payment form your wallet app. Please note; do not send below ${{number_format($data->amount, $basic->decimal)}}. We only credit what you send</p>
                            </div>
                            @else

                            <div class="card-text">
                                <p>Please send <strong>{{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} )</strong> to the Perfect Money account below. Please note; do not send below ${{number_format($data->amount, $basic->decimal)}}. We only credit what you send</p>
                            </div>
                            @endif


                            <div class="referral-form">
                                @if($data->currency->id != 11)
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 font-bold">Wallet Address</h5><a href="#" class="link link-primary link-ucap">Copy</a>
                                </div>
                                <div class="copy-wrap mgb-1-5x mgt-1-5x">
                                <span class="copy-feedback"></span>
                                <input type="text" class="copy-address" value="{{$data->currency->payment_id}}" disabled>
                                <button class="copy-trigger copy-clipboard" data-clipboard-text="{{$data->currency->payment_id}}">
                                <em class="ti ti-files"></em></button></div>
                                @endif


                                <div class="note note-plane note-danger note-sm pdt-1x pl-0">
                                    <p>To enhance your payment processing, click the buton below and upload a screenshot of your successful transaction with your transaction code.</p>
                                </div>
                                <!-- .copy-wrap -->
                            </div>
                            <ul class="share-links">
                                <li> <a href="#" data-toggle="modal" data-target="#pay-confirm""><span class=" schedule-bonus">Process Payment</span></a></li>
                            </ul>
                        </div>
                    </div>




                </div>
            </div>


        </div>
    </div>
</div>
</div>
</div>
</div><!-- .container -->
</div>


<!-- Modal End -->
<div class="modal fade" id="pay-confirm" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <div class="popup-body">
                <h4 class="popup-title">Confirm Your Payment</h4>
                <p class="lead text-primary">Your {{$data->currency->name}} Order With Order Number <strong>{{$data->trx}}</strong> has been placed. </p>
                <p>If you have paid to our {{$data->currency->name}} wallet address, enter your transaction number below and a screenshot of your successful payment page.</p>

                <form role="form" method="POST" action="{{ route('esellupload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="trx" value="{{$data->trx}}" hidden>
                    <div class="input-item input-with-label"><label for="token-address" class="input-item-label">Enter your transaction number</label><input class="input-bordered" type="text" value="" name="trxx"></div>



                    <div class="input-item input-with-label"><label for="nationality" class="input-item-label">Upload Payment Screenshot</label>
                        <div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="photo" accept="image/*"><label for="file-01">Choose a file</label></div>
                    </div>



                    <!-- .input-item -->
                    <ul class="d-flex flex-wrap align-items-center guttar-30px">
                        <li><button type="submit" class="btn btn-primary">Confirm Payment</button>
                </form>
                </li>
                </ul>
                <div class="gaps-2x"></div>
                <div class="gaps-1x d-none d-sm-block"></div>
                <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
                    <p>Do not proceed with this process if you have not made your payment</p>
                </div>
                <div class="note note-plane note-danger"><em class="fas fa-info-circle"></em>
                    <p>In case you sent a different amount, send us a message, {{$basic->sitename}} will update accordingly.</p>
                </div>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- Modal End -->
@endsection