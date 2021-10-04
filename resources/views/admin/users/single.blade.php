@extends('include.admindashboard')

@section('body')

<script>
    function goBack() {
        window.history.back()
    }
</script>

<div class="page-content">
    <div class="container">
        <div class="card content-area">
            <div class="card-innr card-innr-fix">
                <div class="card-head d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">User Details</h4>



                    <div class="d-flex align-items-center guttar-20px">
                        <div class="flex-col d-sm-block d-nsone"><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div>
                        <div class="relative d-inline-block"><a href="#" class="btn btn-dark btn-sm btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                            <div class="toggle-class dropdown-content dropdown-content-top-left">
                                <ul class="dropdown-list">

                                    <li><a href="{{route('user.email',$user->id)}}"><em class="far fa-envelope"></em> Send Mail</a></li>
                                    <li><a href="{{route('user.trans',$user->id)}}"><em class="ti ti-book"></em> Transaction Log</a></li>
                                    <li><a href="{{route('user.login.history',$user->id)}}"><em class="ti ti-power-off"></em> Login History</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#changepass"><em class="ti ti-lock"></em> Change Password</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#editprofile"><em class="ti ti-user"></em> Update Profile</a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gaps-1-5x"></div>
                <div class="data-details d-md-flex">
                    <div class="fake-class"><span class="data-details-title">Successful Purchase</span><span class="data-details-info large" style="color:green; font-weight:600">{{$basic->currency_sym}}{{number_format(App\Transaction::whereUser_id($user->id)->where('type', 'Buy')->where('status', 'Confirmed')->sum('amount'), $basic->decimal)}}</span></div>
                    <div class="fake-class"><span class="data-details-title">Successful Sale</span><span class="data-details-info large" style="color:green; font-weight:600">{{$basic->currency_sym}}{{number_format(App\Transaction::whereUser_id($user->id)->where('type', 'Sell')->where('status', 'Confirmed')->sum('amount'), $basic->decimal)}}</small></span></div>
                    <div class="fake-class"><span class="data-details-title">Account Status</span>
                        @if($user->status == 1)
                        <span class="badge badge-success ucap">Active</span>
                        @else
                        <span class="badge badge-danger ucap">Inactive</span>
                        @endif

                    </div>




                    <ul class="data-vr-list">
                        <li> @if($user->email_verify == 1)
                            <div class="data-state data-state-sm data-state-approved"></div>
                            @else
                            <div class="data-state data-state-sm data-state-pending"></div>
                            @endif
                            Email Verify
                        </li>
                        <li>
                            @if($user->phone_verify == 1)
                            <div class="data-state data-state-sm data-state-approved"></div>
                            @else
                            <div class="data-state data-state-sm data-state-pending"></div>
                            @endif
                            Phone Verify
                        </li>
                        <li>
                            @if($user->verified == 2)
                            <div class="data-state data-state-sm data-state-approved"></div>
                            @elseif($user->verified == 1)
                            <div class="data-state data-state-sm data-state-progress"></div>
                            @else
                            <div class="data-state data-state-sm data-state-pending"></div>
                            @endif

                            KYC Verify
                        </li>
                    </ul>
                </div>

                <br>
                <center>
                    <div class="user-photo"> @if( file_exists($user->image))
                        <img src=" {{url($user->image)}} " width="100" alt="Profile Pic">
                        @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " width="100" alt="Profile Pic">
                        @endif
                    </div>
                </center>
                @php
                $ipcount = \App\UserLogin::whereUser_id($user->id)->count();
                @endphp
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">User Information</h6>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head">Full Name</div>
                        <div class="data-details-des">{{$user->fname . ' '.$user->lname}}</div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Username</div>
                        <div class="data-details-des">{{$user->username}}</div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Email Address</div>
                        <div class="data-details-des">{{$user->email}}</div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Mobile Number</div>
                        <div class="data-details-des">{{$user->phone}}</div>
                    </li><!-- li -->
                    <li>
                        <div class="data-details-head">Date of Birth</div>
                        <div class="data-details-des">
                            {{$user->dob}}
                        </div>
                    </li>
                    <li>
                        <div class="data-details-head">Gender</div>
                        <div class="data-details-des">
                            {{$user->gender}}

                        </div>
                    </li>
                    @if(isset($user->country))
                    <li>
                        <div class="data-details-head">Country</div>
                        <div class="data-details-des">
                            {{$user->country}}


                        </div>
                    </li>
                    @endif

                    @if(isset($user->state))
                    <li>
                        <div class="data-details-head">State</div>
                        <div class="data-details-des">
                            {{$user->state}}


                        </div>
                    </li>
                    @endif


                    <!-- li -->
                </ul>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">More Information</h6>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head">Last Login</div>
                        <div class="data-details-des">



                            @if( $ipcount > 0 )

                            {{ Carbon\Carbon::parse($user->login_time)->diffForHumans() }}
                            @else
                            Unknown
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="data-details-head">Last Login IP</div>
                        <div class="data-details-des">

                            @if( $ipcount > 0 )

                            {{ $last_login->user_ip }}
                            @else
                            Unknown
                            @endif

                        </div>
                    </li>
                    <li>
                        <div class="data-details-head">Last Login Location</div>
                        <div class="data-details-des">

                            @if( $ipcount > 0 )

                            {{ $last_login->location }}
                            @else
                            Unknown
                            @endif

                        </div>
                    </li>
                    <!-- li -->
                </ul>
            </div><!-- .card-innr -->
        </div><!-- .card -->
    </div><!-- .container -->
</div>


<!-- Modal for Edit button -->
<div id="changepass" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong><i class="ti ti-lock"></i> Update
                        Password</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('user.passchange', $user->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('put')}}

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label"><strong>Password</strong></label>
                        <input id="password" type="password" class="input-bordered" name="password" placeholder="Passowrd" required>

                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label"><strong>Confirm
                                Password</strong></label>
                        <input id="password-confirm" type="password" class="input-bordered" placeholder="Confirm Passowrd" name="password_confirmation" required>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary  ">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal for Edit button -->
<div id="fundwallet" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong><i class="ti ti-wallet"></i> Fund Wallet</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('user.balance.update')}}" enctype="multipart/form-data" name="editForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-item input-with-label"><label class="input-item-label">Select Option</label>
                                <div class="select-wrapper"><select class="select-bordered select-block" name="operation">
                                        <option value="1">Credit</option>
                                        <option value="0">Debit</option>
                                    </select></div>
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label><strong>Amount</strong></label>
                            <div class="input-group ">
                                <input type="text" name="amount" class="input-bordered" step="0.01">

                            </div>
                            @if ($errors->has('amount'))
                            <span class="help-block" style="color: red">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 ">
                            <label> <strong>Message</strong></label>
                            <textarea name="message" class="input-bordered" rows="5" placeholder="Write Message.." required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary  ">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal for Edit button -->
<div id="fundcoinwallet" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong><i class="ti ti-server"></i> Fund Crypto Wallet</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('user.coinbalance.update')}}" enctype="multipart/form-data" name="editForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-item input-with-label"><label class="input-item-label">Select Option</label>
                                <div class="select-wrapper"><select class="select-bordered select-block" name="operation">
                                        <option value="1">Credit</option>
                                        <option value="0">Debit</option>
                                    </select></div>
                            </div>

                        </div>


                        <div class="form-group col-md-12">
                            <div class="input-item input-with-label"><label class="input-item-label">Select Wallet</label>
                                <div class="select-wrapper">
                                    <select class="select-bordered select-block" name="wallet">
                                        <option>Choose</option>
                                        @foreach($coin as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label><strong>Amount</strong></label>
                            <div class="input-group ">
                                <input type="text" name="amount" class="input-bordered" step="0.01">

                            </div>
                            @if ($errors->has('amount'))
                            <span class="help-block" style="color: red">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary  ">Update Wallet</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




<!-- Modal for Edit button -->
<div id="editprofile" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong><i class="ti ti-user"></i> Update
                        Profile</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('user.status', $user->id)}}" enctype="multipart/form-data" name="editForm">
                    {{ csrf_field() }}
                    {{method_field('put')}}


                    <div class="tile-body">

                        <div class="row">
                            <div class="form-group col-md-6 {{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label> <strong>First Name</strong></label>
                                <input type="text" name="fname" class="input-bordered" value="{{$user->fname}}">
                                @if ($errors->has('fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label> <strong>Last Name</strong></label>
                                <input type="text" name="lname" class="input-bordered" value="{{$user->lname}}">
                                @if ($errors->has('lname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label><strong>Email</strong></label>
                                <input type="email" name="email" class="input-bordered" value="{{$user->email}}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label><strong>Phone</strong></label>
                                <input type="text" name="phone" class="input-bordered" value="{{$user->phone}}">
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-3">
                                <label> <strong>City</strong></label>
                                <input type="text" name="city" class="input-bordered" value="{{$user->city}}">
                                @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Zip Code</strong></label>
                                <input type="text" name="zip_code" class="input-bordered" value="{{$user->zip_code}}">
                                @if ($errors->has('zip_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="form-group col-md-6">
                                <label><strong>Address</strong></label>
                                <input type="text" name="address" class="input-bordered" value="{{$user->address}}">
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif

                            </div>

                            <div class="form-group col-md-12 ">
                                <label><strong>Country</strong></label>
                                <select name="country" class="input-bordered" id="country">
                                    <option value="">Select Country</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean
                                        Territory
                                    </option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic
                                    </option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The
                                        Democratic
                                        Republic of The
                                    </option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                    </option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories
                                    </option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and
                                        Mcdonald
                                        Islands
                                    </option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City
                                        State)
                                    </option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of
                                    </option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                        People's Republic of
                                    </option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic
                                        Republic
                                    </option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia,
                                        The
                                        Former Yugoslav Republic of
                                    </option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated
                                        States
                                        of
                                    </option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands
                                    </option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory,
                                        Occupied
                                    </option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon
                                    </option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The
                                        Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South
                                        Georgia
                                        and The South Sandwich Islands
                                    </option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China
                                    </option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic
                                        of
                                    </option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands
                                    </option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor
                                        Outlying Islands
                                    </option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>

                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><strong>User Status</strong></label>
                                <input class="input-bordered" data-toggle="toggle" data-onstyle="success" data-size="large" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Block" type="checkbox" value="1" name="status" {{ $user->status == "1" ? 'checked' : '' }}>
                            </div>

                            <div class="form-group col-md-4">
                                <label><strong>Email Verification</strong></label>
                                <input class="form-control" data-toggle="toggle" data-onstyle="success" data-size="large" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="email_verify" {{ $user->email_verify == "1" ? 'checked' : '' }}>
                            </div>
                            <div class="form-group col-md-4">
                                <label><strong>Phone Verification</strong></label>
                                <input class="form-control" data-toggle="toggle" data-onstyle="success" data-size="large" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="phone_verify" {{ $user->phone_verify == "1" ? 'checked' : '' }}>
                            </div>
                        </div>



                    </div>

                    <div class="tile-footer">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@stop