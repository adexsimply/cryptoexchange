@extends('include.userdashboard')

@section('content')
<div class="page-content"><div class="container"><div class="row"><div class="main-content col-lg-12"><div class="content-area card"><div class="card-innr">
  <h4>READ BEFORE YOU PAY INTO OUR BANK ACCOUNT</h4>
        <ul class='list-group text-secondary'>
            <li class='notice list-group-item'>
                Do not pay below the {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}.
            </li>
            <li class="notice list-group-item">
                You are charged {{$basic->currency_sym}}{{number_format($basic->transcharge, $basic->decimal)}} Stamp Duty to the total amount payable. <a href="http://www.cbn.gov.ng/Out/2016/CCD/SCAN0001.pdf">Read more…</a>
            </li>
            <li class="notice list-group-item">
              To avoid funding delay, please write “First Name Transaction ID” e.g "Adewale G2N0001" as the Depositor Name if you are making payment via cash deposit or as a remark/memo if you are making payment via internet transfer, mobile transfer and other electronic means.
            </li>
            <li class="notice list-group-item">
                Payment must originate from your own bank account bearing the same registered names with Gold2Naira. Third-party payment via internet transfer, mobile transfer and other electronic means are not allowed. Third-party payment will be refunded with various charges applied and the reversal of third-party payment involves a lengthy process that can take several weeks.
            </li>
            <li class="notice list-group-item">
                We may request for more documents as a proof that the money was paid by yourself. So, you must be ready to submit them if they are requested.
            </li>
            <li class="notice list-group-item">
                	Do not write any of these words “Bitcoin, Ethereum, Bitcoin Cash, Litecoin, Perfect Money, WebMoney, e-currency, digital currency, etc” as Depositors Name when making payment via cash deposit or as a Remark /Memo in case of internet transfer, mobile transfer and other electronic means. If you violate this term, your account will be BLOCKED.
            </li>
            <li class="notice list-group-item">
                	{{$basic->sitename}} not be RESPONSIBLE for funding a wrong ACCOUNT or WALLET provided by you.
            </li>
            <li class="notice list-group-item">
                Ensure that you check and read the invoice page and your email regularly for our bank details as they may be changed any moment. Payment into any of our old/delisted accounts will not be treated
            </li>
            <li class="notice list-group-item">
                	By proceeding to pay into our bank account, you agree to these terms.
            </li>
        </ul>
<div class="token-overview-wrap"><div class="token-overview"><div class="row"><div class="col-md-4 col-sm-6"><div class="token-bonus token-bonus-sale"><span class="token-overview-title">{{App\Bank::whereId($data->bank)->first()->name}}</span><span class="token-overview-value text-primary">Bank Name</span></div></div><div class="col-md-4 col-sm-6"><div class="token-bonus token-bonus-samount"><span class="token-overview-title">{{App\Bank::whereId($data->bank)->first()->accname}}</span><span class="token-overview-value text-primary">Account Name</span></div></div><div class="col-md-4"><div class="token-total"><span class="token-overview-title font-bold">{{App\Bank::whereId($data->bank)->first()->account}}</span><span class="token-overview-value schedule-titl text-primary">Account Number</span></div></div></div></div><div class="note note-plane note-danger note-sm pdt-1x pl-0"><p>Do not pay below {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}} After payment, click Confirm Payment button below and fill/upload your payment information.</p></div></div>




 <div class="pdb-1x"><h5 class="schedule-title"><span>Amount Payable</span></h5><span class="schedule-title text-secondary">{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</span>
<br>
 <a href="#" data-toggle="modal" data-target="#pay-confirm"><span class="schedule-bonus">Submit</span></a>

 </div>


</div></div>


</div></div> </div>                             </div></div></div><!-- .container --></div>

<!-- Modal End --><div class="modal fade" id="pay-confirm" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Confirm Your Payment</h4><p class="lead text-primary">Your Order no. <strong>{{$data->trx}}</strong> has been placed successfully. </p><p>The tokens balance will appear in your account only after you transaction has been confirmed  and approved our team.</p><p>To <strong>speed up verifcation</strong> proccesing please enter <strong>only  vald accouNt number</strong> from where you’ll transferring your ethereum to our address.</p>


<form role="form" method="POST" action="{{ route('ebuyupload') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
<input name="trx" hidden value="{{$data->trx}}">
<div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Amount Paid</label><input name="amount" placeholder="Enter Amount Paid" class="input-bordered" type="text"></div></div>

<div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Depositor's Name</label><input   placeholder="Enter Depositor's Name'" class="input-bordered" name="payer" type="text"></div></div></div>


<div class="row">
<div class="col-md-6"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Transaction Number</label><input name="tnum" placeholder="Enter Payment Trasaction NUmber " class="input-bordered" type="text"></div></div>

<div class="col-md-6"><div class="input-item input-with-label"><label for="nationality" class="input-item-label">Upload Payment Screenshot</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="photo" accept="image/*"><label for="file-01">Choose a file</label></div></div></div>
</div>





<div class="input-item input-with-label"><label for="token-address" class="input-item-label">Select Payment Method</label>
<select required  class="select-bordered select-block" name="method">
<option selected>Choose...</option>
@foreach($method as $data)
<option value="{{$data->id}}">{{$data->name}} </option>
@endforeach
</select>


</div><!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Confirm Payment</button></form></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>Do not make payment through exchange (Kraken, Bitfinex). You can use MayEtherWallet, MetaMask, Mist wallets etc.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>In case you send a different amount, number of TWZ tokens will update accordingly.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->


@endsection
