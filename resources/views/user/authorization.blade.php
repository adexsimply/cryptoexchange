@extends('include.front')
@section('content')


<section class="section section-s bg-light-alt">
@if(Auth::user()->status == 0)
<main class="nk-pages"><div class="section"><div class="container"><div class="nk-blocks d-flex justify-content-center"><div class="ath-container m-0"><div class="ath-body"><h5 class="ath-heading title">Account Blocked<small class="tc-default">Your account has been blocked for possible violation of terms</small></h5><div class="field-item"><div class="field-wrap"></div></div><button class="btn btn-primary btn-block btn-md">Contact Admin</button></div></div></div></div></div></main>

 @elseif(Auth::user()->bankyes == 78787878)

<main class="nk-pages"><div class="section"><div class="container"><div class="nk-blocks d-flex justify-content-center"><div class="ath-container m-0"><div class="ath-body"><h5 class="ath-heading tistle">Bank Account Details<small class="tc-default">Please enter only correct account details as {{$basic->sitename}} will not be liable to any  loss arising form you providing wrong account details</small></h5>

  @if (session('ready'))


<table class="table"><tbody>
<tr><td class="table-head">Bank Name</td><td class="table-des">{{Auth::user()->bank}}</td></tr>
<tr><td class="table-head">Account Name</td><td class="table-des">{{Auth::user()->accountname}}</td></tr>
<tr><td class="table-head">Account Number</td><td class="table-des">{{Auth::user()->accountno}}</td></tr> </tbody></table>

<a href="{{route('bank.vvalidate',Auth::user()->accountno)}}">
<button  class="btn btn-outline btn-primary btn-block btn-sm">Save Bank</button></a>
@else
 <form action="{{ route('veri.bank')}}" method="post">
{{ csrf_field() }}
   <div class="field-item"><div class="field-wrap">
<select name="bank" required class="select" data-select2-theme="bordered" >
<option>Select Bank</option>
<? $accounts = DB::table('localbanks')->get(); ?>
@foreach($accounts as $accounts)
<option value="{{$accounts->code}}">{{$accounts->bank}}</option>
@endforeach
</select>
</div></div>

<div class="field-item"><div class="field-wrap">
<input type="text" name="accountno"  requlired  value="{{ old('accountname') }}" class="input-bordered" placeholder="Account Number"></div></div>
<button type="submit" class="btn btn-outline btn-primary btn-block btn-sm">Validate</button>


@endif


</div></div></div></div></div></div></main>
</form>
 @elseif(Auth::user()->email_verify == 0)
<main class="nk-pages"><div class="section"><div class="container"><div class="nk-blocks d-flex justify-content-center"><div class="ath-container m-0"><div class="ath-body"><h5 class="ath-heading title">Email Verification<small class="tc-default">Please enter the code sent to {{Auth::user()->email}}</small></h5>
 <form  action="{{ route('user.email-verify')}}" method="post">
@csrf
 <input type="hidden" name="id" value="{{Auth::user()->id}}">
<div class="field-item"><div class="field-wrap">
<input type="text" class="input-bordered" name="email_code" placeholder="Enter Code"></div></div><button type="submit" class="btn btn-primary btn-block btn-md">Verify Email</button></form><div class="ath-note text-center"><a href=#">Didn't get any code? </a>

 <form  action="{{route('user.send-emailVcode') }}" method="post">
   @csrf
<input type="submit" class="btn btn-outline btn-primary btn-block btn-sm" value="Send Code">
</div></form></div></div></div></div></div></main>
@elseif(Auth::user()->phone_verify == 0)
<main class="nk-pages"><div class="section"><div class="container"><div class="nk-blocks d-flex justify-content-center"><div class="ath-container m-0"><div class="ath-body"><h5 class="ath-heading title">Phone Verification<small class="tc-default">Please enter the code sent to {{Auth::user()->phone}}</small></h5>
 <form  action="{{ route('user.sms-verify')}}" method="post">
@csrf
 <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                    <div class="field-item"><div class="field-wrap">
<input type="text" class="input-bordered" name="sms_code" placeholder="Enter Code"></div></div><button class="btn btn-primary btn-block btn-md">Verify Phone</button></form><div class="ath-note text-center"><a href=#">Didn't get any code? </a>
 <form  action="{{route('user.send-vcode') }}" method="post">
   @csrf

<input type="submit" class="btn btn-outline btn-primary btn-block btn-sm" value="Send Code">
</div></form></div></div></div></div></div></main>
@else
            @php return redirect('user/home') @endphp

        @endif
</section>

@endsection
