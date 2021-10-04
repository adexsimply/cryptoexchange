@extends('include.userdashboard')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="main-content col-lg-8">
        <div class="content-area card">
          <div class="card-innr">
            <div class="card-head">
              <h4 class="card-title">Profile Details</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
              <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#personal-data">Personal Data</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Settings</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password">Password</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bank">Bank Account Details</a></li>
            </ul><!-- .nav-tabs-line -->
            <div class="tab-content" id="profile-details">
              <div class="tab-pane fade show active" id="personal-data">{!! Form::open(['method'=>'post','role'=>'form','name' =>'editForm', 'files'=>true]) !!}

                <div class="row">

                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="full-name" class="input-item-label">First Name</label><input name="fname" class="input-bordered" type="text" value="{{$user->fname}}">

                    </div><!-- .input-item -->
                  </div>
                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="email-address" class="input-item-label">Last Name</label><input name="lname" class="input-bordered" type="text" value="{{$user->lname}}">

                    </div><!-- .input-item -->
                  </div>

                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">Email Address</label><input class="input-bordered" type="email" id="mobile-number" value="{{$user->email}}" readonly name="email"></div>
                    <!-- .input-item -->
                  </div>

                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">Phone Numbner</label><input class="input-bordered" type="text" id="mobile-number" value="{{$user->phone}}" name="phone"></div>
                    <!-- .input-item -->
                  </div>

                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">County <small>{{$user->country}}</small></label>
                      <!-- <select onchange="print_state('state', this.selectedIndex);" id="country" name="country" class="select-bordered select-block" /></select> -->
                      <select onchange="print_state('state', this.selectedIndex);" id="country" name="country" class="select-bordered select-block">
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
                    <!-- .input-item -->
                  </div>


                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">Address</label><input class="input-bordered" type="text" id="mobile-number" value="{{$user->address}}" name="address"></div>
                    <!-- .input-item -->
                  </div>


                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">City</label><input class="input-bordered" type="text" id="mobile-number" value="{{$user->city}}" name="city"></div>
                    <!-- .input-item -->
                  </div>


                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="mobile-number" class="input-item-label">Zip Code</label><input class="input-bordered" type="text" id="mobile-number" value="{{$user->zip_code}}" name="zip_code"></div>
                    <!-- .input-item -->
                  </div>




                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="date-of-birth" class="input-item-label">Date of Birth</label><input class="input-bordered date-picker-dob" value="{{$user->dob}}" type="text" id="date-of-birth" name="dob"></div><!-- .input-item -->
                  </div><!-- .col -->



                  <div class="col-md-6">
                    <div class="input-item input-with-label"><label for="nationality" class="input-item-label">Upload Avatar</label>
                      <div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" class="input-file" id="file-01" name="image" accept="image/*"><label for="file-01">Choose a file</label></div>


                    </div><!-- .input-item -->
                  </div><!-- .col -->
                </div><!-- .row -->
                <div class="gaps-1x"></div><!-- 10px gap -->
                <div class="d-sm-flex justify-content-between align-items-center"><button class="btn btn-primary">Update Profile</button>
                  <div class="gaps-2x d-sm-none"></div>
                </div> {!! Form::close() !!}
                <!-- form -->
              </div><!-- .tab-pane -->
              <div class="tab-pane fade" id="bank">
                <form method="post" action="{{route('check_bank') }}">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-item input-with-label">
                        <label for="old-pass" class="input-item-label">Select Bank</label>
                        <select name="bank" class="input-bordered" required>
                          <option value="">Choose...</option>
                          @foreach($banks as $bank)
                          <option value="{{$bank->code}}" {{ Auth::user()->bank == $bank->bank ? "selected" : '' }}>{{$bank->bank}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('bank'))
                        <span class="error">
                          {{ $errors->first('bank') }}
                        </span><br>
                        @endif
                      </div><!-- .input-item -->
                    </div><!-- .col -->
                  </div><!-- .row -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-item input-with-label"><label for="new-pass" class="input-item-label">Account Name</label>
                        <input class="input-bordered" type="text" value="{{Auth::user()->accountname }}" readonly name="acc_name" style="cursor: no-drop; background-color: #e9eff9;">
                      </div><!-- .input-item -->
                    </div>

                    <!-- .col -->
                    <div class="col-md-12">
                      <div class="input-item input-with-label"><label for="confirm-pass" class="input-item-label">Account Number</label>
                        <input class="input-bordered" type="number" id="confirm-pass" name="acctnumber" value="{{Auth::user()->accountno }}" required>
                        @if ($errors->has('acctnumber'))
                        <span class="error">
                          {{ $errors->first('acctnumber') }}
                        </span><br>
                        @endif
                      </div><!-- .input-item -->
                    </div><!-- .col -->
                  </div><!-- .row -->

                  <div class="note note-plane note-info pdb-1x">
                    <!-- <em class="fas fa-info-circle"></em> -->
                    <!-- <p>Password should be minmum 8 letter and include lower and uppercase letter for better security.</p> -->
                  </div>
                  <div class="gaps-1x"></div>
                  <div class="d-sm-flex /justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>

                </form>
              </div>
              <div class="tab-pane fade" id="settings">
                <div class="pdb-1-5x">
                  <h5 class="card-title card-title-sm text-dark">Security Settings</h5>
                </div>
                <div class="input-item"><input type="checkbox" class="input-switch input-switch-sm" id="save-log" checked><label for="save-log">Save my Activities Log</label></div>
                <div class="input-item"><input type="checkbox" class="input-switch input-switch-sm" id="pass-change-confirm"><label for="pass-change-confirm">Confirm me through email before password change</label></div>
                <div class="pdb-1-5x">
                  <h5 class="card-title card-title-sm text-dark">Manage Notification</h5>
                </div>
                <div class="input-item"><input type="checkbox" class="input-switch input-switch-sm" id="latest-news" checked><label for="latest-news">Notify me by email about sales and latest news</label></div>
                <div class="input-item"><input type="checkbox" class="input-switch input-switch-sm" id="activity-alert" checked><label for="activity-alert">Alert me by email for unusual activity.</label></div>
                <div class="gaps-1x"></div>
                <div class="d-flex justify-content-between align-items-center"><span></span><span class="text-success"><em class="ti ti-check-box"></em> Setting has been updated</span></div>
              </div><!-- .tab-pane -->
              <div class="tab-pane fade" id="password">
                <form method="post" action="{{route('user.change-password') }}">
                  @csrf

                  <div class="row">


                    <div class="col-md-6">
                      <div class="input-item input-with-label">

                        <label for="old-pass" class="input-item-label">Old Password</label><input class="input-bordered" type="password" id="old-pass" name="current_password">
                      </div><!-- .input-item -->
                    </div><!-- .col -->
                  </div><!-- .row -->

                  <div class="row">

                    <div class="col-md-6">
                      <div class="input-item input-with-label"><label for="new-pass" class="input-item-label">New Password</label><input class="input-bordered" type="password" id="new-pass" name="password"></div><!-- .input-item -->
                    </div>

                    <!-- .col -->
                    <div class="col-md-6">
                      <div class="input-item input-with-label"><label for="confirm-pass" class="input-item-label">Confirm New Password</label><input class="input-bordered" type="password" id="confirm-pass" name="password_confirmation"></div><!-- .input-item -->
                    </div><!-- .col -->
                  </div><!-- .row -->

                  <div class="note note-plane note-info pdb-1x"><em class="fas fa-info-circle"></em>
                    <p>Password should be minmum 8 letter and include lower and uppercase letter for better security.</p>
                  </div>
                  <div class="gaps-1x"></div>

                  <!-- 10px gap -->
                  <div class="d-sm-flex /justify-content-between align-items-center"><button type="submit" class="btn btn-primary">Update</button>

                </form>
              </div>
            </div><!-- .tab-pane -->
          </div><!-- .tab-content -->
        </div><!-- .card-innr -->
      </div><!-- .card -->
      <div class="content-area card">
        <div class="card-innr">
          <div class="card-head">
            <h4 class="card-title">Two-Factor Verification</h4>
          </div>
          <p>Two-factor authentication is a method for protection your web account. When it is activated you need to enter not only your password, but also a special code. You can receive this code by in mobile app. Even if third person will find your password, then can't access with that code.</p>
          <div class="d-sm-flex justify-content-between align-items-center pdt-1-5x"><span class="text-light ucap d-inline-flex align-items-center"><span class="mb-0"><small>Current Status:</small></span> <span class="badge badge-disabled ml-2">Disabled</span></span>
            <div class="gaps-2x d-sm-none"></div><button class="order-sm-first btn btn-primary">Enable 2FA</button>
          </div>
        </div><!-- .card-innr -->
      </div><!-- .card -->
    </div><!-- .col -->
    <div class="aside sidebar-right col-lg-4">
      <div class="account-info card">
        <div class="card-innr">
          <h6 class="card-title card-title-sm">Account Verification Status</h6>
          <ul class="btn-grp">
            <li>

              @if(Auth::user()->email_verify == 0)
              <a href="#" class="btn btn-auto btn-xs btn-danger">Email Verify Pending</a>
              @else
              <a href="#" class="btn btn-auto btn-xs btn-success">Email Verify Pending</a>
              @endif

            </li>
            <li>
              @if(Auth::user()->phone_verify == 0)
              <a href="#" class="btn btn-auto btn-xs btn-danger">Phone Verify Pending</a>
              @else
              <a href="#" class="btn btn-auto btn-xs btn-success">Phone Verify Pending</a>
              @endif
            </li>
          </ul>
        </div>
      </div>
      <div class="referral-info card">
        <div class="card-innr">
          <h6 class="card-title card-title-sm">Earn with Referral</h6>
          <p class=" pdb-0-5x">Invite your friends &amp; family and receive a <strong><span class="text-primary">bonus of {{$basic->currency_sym}}{{$basic->ref}}</span> when they get verified and complete a transaction</strong></p>
          <div class="copy-wrap mgb-0-5x">
            <span class="copy-feedback">
            </span>
            <input type="text" class="copy-address" value="{{ route('refer.register',auth::user()->username) }}" disabled>
            <button class="copy-trigger copy-clipboard" data-clipboard-text="{{ route('refer.register',auth::user()->username) }}"><em class="ti ti-files"></em></button>
          </div>
        </div>
      </div>
      <div class="kyc-info card">
        <div class="card-innr">
          <h6 class="card-title card-title-sm">Identity Verification - KYC</h6>
          <!-- <p>To comply with regulation and be eligible for daily bonus and cryptocurrency purchase , customers will have to go through indentity verification.</p> -->
          <p>In compliance with regulations and be eligible for transactions, every customers must be verified.</p>

          @if(Auth::user()->verified == 1)
          <p class="lead text-light pdb-0-5x">Your have submitted your KYC request. You will be notified once approved.</p>
          <a href="{{route('verification')}}" class="btn btn-primary btn-block">View Submission</a>
          @elseif(Auth::user()->verified == 2)
          <p class="lead text-light pdb-0-5x">Your KYC verification request has been approved. You are eligible for bonus and offers</p>
          <a href="{{route('verification')}}" class="btn btn-primary btn-block">View Submission</a>
          @elseif(Auth::user()->verified == 3)
          <p class="lead text-light pdb-0-5x">Your KYC verification request has been rejected. Please try again now.</p>
          <a href="{{route('verification')}}" class="btn btn-primary btn-block">Try Again</a>
          @else
          <p class="lead text-light pdb-0-5x">You have not submitted your KYC application to verify your indentity.</p>
          <a href="{{route('verification')}}" class="btn btn-primary btn-block">Click to Proceed</a>
          @endif


          <h6 class="kyc-alert text-danger">* KYC verification required for purchase of cryptocurrencies</h6>
        </div>
      </div>
    </div><!-- .col -->
  </div><!-- .container -->
</div><!-- .container -->
</div><!-- .page-content -->
@endsection