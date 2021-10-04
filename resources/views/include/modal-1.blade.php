<!-- Modal End -->
<div class="modal fade" id="deposit-online" tabindex="-1">
  <div class="modal-dialog modal-dialog-md modal-dialog-centered">
    <div class="modal-content pb-0">
      <div class="popup-body">
        <h4 class="popup-title">Fund Your Deposit Wallet</h4>
        <p class="lead">You currently have <span>{{$basic->currency}}{{number_format(Auth::user()->balance, $basic->decimal)}}</span> in your deposit wallet. Fill the form below to proceed.</p>
        <p>You can choose any of following payment method to fund your wallet. The fund will appear in your account after successfull payment.</p>
        <h5 class="mgt-1-5x font-mid">Select payment method:</h5>
        <form method="post" action="{{route('deposit.data-insert')}}">
          @csrf
          <select class="input-bordered select-block" required name="gateway">
            <option>Choose... For Me now dude</option>
            <option value="bank">Bank Transfer</option>
            @foreach($gates as $gate)
            <option data-charge="{{$gate->percent_charge}}" value="{{$gate->id}}">{{$gate->name}}</option>
            @endforeach
          </select>
          <h5 class="mgt-1-5x font-mid">Enter Amount:</h5>
          <div class="copy-wrap mgb-0-5x">
            <input required type="number" name="amount" class="copy-address">
            <buttonn class="copy-trigger"><em class="ti ti-wallet"></em></buttonn>
          </div>
          <span class="text-light font-italic mgb-2x"><small>* Payment gateway company may charge you a processing fees.</small></span>
          <div class="pdb-2-5x pdt-1-5x"><input required type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term-3"><label for="agree-term-3">I hereby agree to the <strong>token purchase aggrement &amp; token sale term</strong>.</label></div>
          <ul class="d-flex flex-wrap align-items-center guttar-30px">
            <li><button type="submit" class="btn btn-primary">Accept &amp; Process Payment <em class="ti ti-arrow-right mgl-2x"></em></a></li>
          </ul>
          <div class="gaps-2x"></div>
          <div class="gaps-1x d-none d-sm-block"></div>
          <div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em>
            <p class="text-light">You will automatically redirect for payment after your order placing.</p>
        </form>
      </div>
    </div>
  </div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div><!-- Modal End -->