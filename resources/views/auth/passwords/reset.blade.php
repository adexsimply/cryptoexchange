@extends('include.front')

@section('content')

   <main class="nk-pages"><div class="section"><div class="container"><div class="nk-blocks d-flex justify-content-center"><div class="ath-container m-0"><div class="ath-body"><h5 class="ath-heading title">Phone Verification<small class="tc-default">Please enter the code sent to {{Auth::user()->phone}}</small></h5>
 <form  action="{{ route('user.password.request') }}" method="post">
{{csrf_field()}}
 <input type="hidden" name="token" value="{{ $token }}">
  <input type="email" name="email" value="{{$email}}" class="input-field" placeholder="Email Address" hidden>
                                    <div class="field-item"><div class="field-wrap">
<input type="password" name="password"  class="input-bordered" placeholder="New Password"></div></div>

 <div class="field-item"><div class="field-wrap">
<input type="password" name="password_confirmation" class="input-bordered" placeholder="Confirm Password"></div></div>


<button class="btn btn-primary btn-block btn-md">Update Password</button></form><div class="ath-note text-center">



</div></form></div></div></div></div></div></main>
 </section>

@endsection
