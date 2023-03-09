@extends('layouts.cpanel.app')
@section('content')

    <!-- <div class="card ">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="qualification">{{ trans('cruds.user.fields.qualification') }}</label>
                    <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', '') }}" required>
                    @if($errors->has('qualification'))
                        <div class="invalid-feedback">
                            {{ $errors->first('qualification') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.qualification_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" >
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}" required>
                    @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="whatsapp_phone">{{ trans('cruds.user.fields.whatsapp_phone') }}</label>
                    <input class="form-control {{ $errors->has('whatsapp_phone') ? 'is-invalid' : '' }}" type="text" name="whatsapp_phone" id="whatsapp_phone" value="{{ old('whatsapp_phone', '') }}" required>
                    @if($errors->has('whatsapp_phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('whatsapp_phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="home_address">{{ trans('cruds.user.fields.home_address') }}</label>
                    <input class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}" type="text" name="home_address" id="home_address" value="{{ old('home_address', '') }}" required>
                    @if($errors->has('home_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('home_address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.home_address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="jobId">{{ trans('cruds.user.fields.jobId') }}</label>
                    <input class="form-control {{ $errors->has('jobId') ? 'is-invalid' : '' }}" type="text" name="jobId" id="jobId" value="{{ old('jobId', '') }}" required>
                    @if($errors->has('jobId'))
                        <div class="invalid-feedback">
                            {{ $errors->first('jobId') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.jobId_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="image">{{ trans('cruds.user.fields.image') }}</label>
                        <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                    @if($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="category_id">عائلة الصنف</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                        @foreach($categories as $id => $entry)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sample.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="item_id">{{ trans('cruds.sampleStock.fields.item') }}</label>
                    <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                        @foreach($items as $id => $entry)
                            <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('item'))
                        <div class="invalid-feedback">
                            {{ $errors->first('item') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sampleStock.fields.item_helper') }}</span>
                </div>

                <div class="form-group ">
                    <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                        <label>الحالة</label>
                        <span class="switch">
                            <label>
                                <input type="checkbox" checked="checked" name="status" id="status">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div> -->
	<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<div class="card card-custom">
									<div class="card-body p-0">
										<!--begin: Wizard-->
										<div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
											<!--begin: Wizard Nav-->
											<div class="wizard-nav">
												<div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3" style="display:none;">
													<!--begin::Wizard Step 1 Nav-->
													<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
														<div class="wizard-label">
															<h3 class="wizard-title">
															<span>1.</span>Setup Location</h3>
															<div class="wizard-bar"></div>
														</div>
													</div>
													<!--end::Wizard Step 1 Nav-->
													<!--begin::Wizard Step 2 Nav-->
													<div class="wizard-step" data-wizard-type="step">
														<div class="wizard-label">
															<h3 class="wizard-title">
															<span>2.</span>Enter Details</h3>
															<div class="wizard-bar"></div>
														</div>
													</div>
													<!--end::Wizard Step 2 Nav-->
													<!--begin::Wizard Step 3 Nav-->
													<div class="wizard-step" data-wizard-type="step">
														<div class="wizard-label">
															<h3 class="wizard-title">
															<span>3.</span>Select Services</h3>
															<div class="wizard-bar"></div>
														</div>
													</div>
													<!--end::Wizard Step 3 Nav-->
													<!--begin::Wizard Step 4 Nav-->
													<div class="wizard-step" data-wizard-type="step">
														<div class="wizard-label">
															<h3 class="wizard-title">
															<span>4.</span>Delivery Address</h3>
															<div class="wizard-bar"></div>
														</div>
													</div>
													<!--end::Wizard Step 4 Nav-->
												</div>
											</div>
											<!--end: Wizard Nav-->
											<!--begin: Wizard Body-->
											<div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
												<div class="col-xl-12 col-xxl-7">
													<!--begin: Wizard Form-->
													<form class="form" id="kt_form">
														<!--begin: Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h4 class="mb-10 font-weight-bold text-dark">Setup Your Current Location</h4>
															<!--begin::Input-->
															<div class="form-group">
																<label>Address Line 1</label>
																<input type="text" class="form-control" name="address1" placeholder="Address Line 1" value="Address Line 1" />
																<span class="form-text text-muted">Please enter your Address.</span>
															</div>
															<!--end::Input-->
															<!--begin::Input-->
															<div class="form-group">
																<label>Address Line 2</label>
																<input type="text" class="form-control" name="address2" placeholder="Address Line 2" value="Address Line 2" />
																<span class="form-text text-muted">Please enter your Address.</span>
															</div>
															<!--end::Input-->
															<div class="row">
																<div class="col-xl-6">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>Postcode</label>
																		<input type="text" class="form-control" name="postcode" placeholder="Postcode" value="3000" />
																		<span class="form-text text-muted">Please enter your Postcode.</span>
																	</div>
																	<!--end::Input-->
																</div>
																<div class="col-xl-6">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="city" placeholder="City" value="Melbourne" />
																		<span class="form-text text-muted">Please enter your City.</span>
																	</div>
																	<!--end::Input-->
																</div>
															</div>
															<div class="row">
																<div class="col-xl-6">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>State</label>
																		<input type="text" class="form-control" name="state" placeholder="State" value="VIC" />
																		<span class="form-text text-muted">Please enter your State.</span>
																	</div>
																	<!--end::Input-->
																</div>
																<div class="col-xl-6">
																	<!--begin::Select-->
																	<div class="form-group">
																		<label>Country</label>
																		<select name="country" class="form-control">
																			<option value="">Select</option>
																			<option value="AF">Afghanistan</option>
																			<option value="AX">Åland Islands</option>
																			<option value="AL">Albania</option>
																			<option value="DZ">Algeria</option>
																			<option value="AS">American Samoa</option>
																			<option value="AD">Andorra</option>
																			<option value="AO">Angola</option>
																			<option value="AI">Anguilla</option>
																			<option value="AQ">Antarctica</option>
																			<option value="AG">Antigua and Barbuda</option>
																			<option value="AR">Argentina</option>
																			<option value="AM">Armenia</option>
																			<option value="AW">Aruba</option>
																			<option value="AU" selected="selected">Australia</option>
																			<option value="AT">Austria</option>
																			<option value="AZ">Azerbaijan</option>
																			<option value="BS">Bahamas</option>
																			<option value="BH">Bahrain</option>
																			<option value="BD">Bangladesh</option>
																			<option value="BB">Barbados</option>
																			<option value="BY">Belarus</option>
																			<option value="BE">Belgium</option>
																			<option value="BZ">Belize</option>
																			<option value="BJ">Benin</option>
																			<option value="BM">Bermuda</option>
																			<option value="BT">Bhutan</option>
																			<option value="BO">Bolivia, Plurinational State of</option>
																			<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
																			<option value="BA">Bosnia and Herzegovina</option>
																			<option value="BW">Botswana</option>
																			<option value="BV">Bouvet Island</option>
																			<option value="BR">Brazil</option>
																			<option value="IO">British Indian Ocean Territory</option>
																			<option value="BN">Brunei Darussalam</option>
																			<option value="BG">Bulgaria</option>
																			<option value="BF">Burkina Faso</option>
																			<option value="BI">Burundi</option>
																			<option value="KH">Cambodia</option>
																			<option value="CM">Cameroon</option>
																			<option value="CA">Canada</option>
																			<option value="CV">Cape Verde</option>
																			<option value="KY">Cayman Islands</option>
																			<option value="CF">Central African Republic</option>
																			<option value="TD">Chad</option>
																			<option value="CL">Chile</option>
																			<option value="CN">China</option>
																			<option value="CX">Christmas Island</option>
																			<option value="CC">Cocos (Keeling) Islands</option>
																			<option value="CO">Colombia</option>
																			<option value="KM">Comoros</option>
																			<option value="CG">Congo</option>
																			<option value="CD">Congo, the Democratic Republic of the</option>
																			<option value="CK">Cook Islands</option>
																			<option value="CR">Costa Rica</option>
																			<option value="CI">Côte d'Ivoire</option>
																			<option value="HR">Croatia</option>
																			<option value="CU">Cuba</option>
																			<option value="CW">Curaçao</option>
																			<option value="CY">Cyprus</option>
																			<option value="CZ">Czech Republic</option>
																			<option value="DK">Denmark</option>
																			<option value="DJ">Djibouti</option>
																			<option value="DM">Dominica</option>
																			<option value="DO">Dominican Republic</option>
																			<option value="EC">Ecuador</option>
																			<option value="EG">Egypt</option>
																			<option value="SV">El Salvador</option>
																			<option value="GQ">Equatorial Guinea</option>
																			<option value="ER">Eritrea</option>
																			<option value="EE">Estonia</option>
																			<option value="ET">Ethiopia</option>
																			<option value="FK">Falkland Islands (Malvinas)</option>
																			<option value="FO">Faroe Islands</option>
																			<option value="FJ">Fiji</option>
																			<option value="FI">Finland</option>
																			<option value="FR">France</option>
																			<option value="GF">French Guiana</option>
																			<option value="PF">French Polynesia</option>
																			<option value="TF">French Southern Territories</option>
																			<option value="GA">Gabon</option>
																			<option value="GM">Gambia</option>
																			<option value="GE">Georgia</option>
																			<option value="DE">Germany</option>
																			<option value="GH">Ghana</option>
																			<option value="GI">Gibraltar</option>
																			<option value="GR">Greece</option>
																			<option value="GL">Greenland</option>
																			<option value="GD">Grenada</option>
																			<option value="GP">Guadeloupe</option>
																			<option value="GU">Guam</option>
																			<option value="GT">Guatemala</option>
																			<option value="GG">Guernsey</option>
																			<option value="GN">Guinea</option>
																			<option value="GW">Guinea-Bissau</option>
																			<option value="GY">Guyana</option>
																			<option value="HT">Haiti</option>
																			<option value="HM">Heard Island and McDonald Islands</option>
																			<option value="VA">Holy See (Vatican City State)</option>
																			<option value="HN">Honduras</option>
																			<option value="HK">Hong Kong</option>
																			<option value="HU">Hungary</option>
																			<option value="IS">Iceland</option>
																			<option value="IN">India</option>
																			<option value="ID">Indonesia</option>
																			<option value="IR">Iran, Islamic Republic of</option>
																			<option value="IQ">Iraq</option>
																			<option value="IE">Ireland</option>
																			<option value="IM">Isle of Man</option>
																			<option value="IL">Israel</option>
																			<option value="IT">Italy</option>
																			<option value="JM">Jamaica</option>
																			<option value="JP">Japan</option>
																			<option value="JE">Jersey</option>
																			<option value="JO">Jordan</option>
																			<option value="KZ">Kazakhstan</option>
																			<option value="KE">Kenya</option>
																			<option value="KI">Kiribati</option>
																			<option value="KP">Korea, Democratic People's Republic of</option>
																			<option value="KR">Korea, Republic of</option>
																			<option value="KW">Kuwait</option>
																			<option value="KG">Kyrgyzstan</option>
																			<option value="LA">Lao People's Democratic Republic</option>
																			<option value="LV">Latvia</option>
																			<option value="LB">Lebanon</option>
																			<option value="LS">Lesotho</option>
																			<option value="LR">Liberia</option>
																			<option value="LY">Libya</option>
																			<option value="LI">Liechtenstein</option>
																			<option value="LT">Lithuania</option>
																			<option value="LU">Luxembourg</option>
																			<option value="MO">Macao</option>
																			<option value="MK">Macedonia, the former Yugoslav Republic of</option>
																			<option value="MG">Madagascar</option>
																			<option value="MW">Malawi</option>
																			<option value="MY">Malaysia</option>
																			<option value="MV">Maldives</option>
																			<option value="ML">Mali</option>
																			<option value="MT">Malta</option>
																			<option value="MH">Marshall Islands</option>
																			<option value="MQ">Martinique</option>
																			<option value="MR">Mauritania</option>
																			<option value="MU">Mauritius</option>
																			<option value="YT">Mayotte</option>
																			<option value="MX">Mexico</option>
																			<option value="FM">Micronesia, Federated States of</option>
																			<option value="MD">Moldova, Republic of</option>
																			<option value="MC">Monaco</option>
																			<option value="MN">Mongolia</option>
																			<option value="ME">Montenegro</option>
																			<option value="MS">Montserrat</option>
																			<option value="MA">Morocco</option>
																			<option value="MZ">Mozambique</option>
																			<option value="MM">Myanmar</option>
																			<option value="NA">Namibia</option>
																			<option value="NR">Nauru</option>
																			<option value="NP">Nepal</option>
																			<option value="NL">Netherlands</option>
																			<option value="NC">New Caledonia</option>
																			<option value="NZ">New Zealand</option>
																			<option value="NI">Nicaragua</option>
																			<option value="NE">Niger</option>
																			<option value="NG">Nigeria</option>
																			<option value="NU">Niue</option>
																			<option value="NF">Norfolk Island</option>
																			<option value="MP">Northern Mariana Islands</option>
																			<option value="NO">Norway</option>
																			<option value="OM">Oman</option>
																			<option value="PK">Pakistan</option>
																			<option value="PW">Palau</option>
																			<option value="PS">Palestinian Territory, Occupied</option>
																			<option value="PA">Panama</option>
																			<option value="PG">Papua New Guinea</option>
																			<option value="PY">Paraguay</option>
																			<option value="PE">Peru</option>
																			<option value="PH">Philippines</option>
																			<option value="PN">Pitcairn</option>
																			<option value="PL">Poland</option>
																			<option value="PT">Portugal</option>
																			<option value="PR">Puerto Rico</option>
																			<option value="QA">Qatar</option>
																			<option value="RE">Réunion</option>
																			<option value="RO">Romania</option>
																			<option value="RU">Russian Federation</option>
																			<option value="RW">Rwanda</option>
																			<option value="BL">Saint Barthélemy</option>
																			<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
																			<option value="KN">Saint Kitts and Nevis</option>
																			<option value="LC">Saint Lucia</option>
																			<option value="MF">Saint Martin (French part)</option>
																			<option value="PM">Saint Pierre and Miquelon</option>
																			<option value="VC">Saint Vincent and the Grenadines</option>
																			<option value="WS">Samoa</option>
																			<option value="SM">San Marino</option>
																			<option value="ST">Sao Tome and Principe</option>
																			<option value="SA">Saudi Arabia</option>
																			<option value="SN">Senegal</option>
																			<option value="RS">Serbia</option>
																			<option value="SC">Seychelles</option>
																			<option value="SL">Sierra Leone</option>
																			<option value="SG">Singapore</option>
																			<option value="SX">Sint Maarten (Dutch part)</option>
																			<option value="SK">Slovakia</option>
																			<option value="SI">Slovenia</option>
																			<option value="SB">Solomon Islands</option>
																			<option value="SO">Somalia</option>
																			<option value="ZA">South Africa</option>
																			<option value="GS">South Georgia and the South Sandwich Islands</option>
																			<option value="SS">South Sudan</option>
																			<option value="ES">Spain</option>
																			<option value="LK">Sri Lanka</option>
																			<option value="SD">Sudan</option>
																			<option value="SR">Suriname</option>
																			<option value="SJ">Svalbard and Jan Mayen</option>
																			<option value="SZ">Swaziland</option>
																			<option value="SE">Sweden</option>
																			<option value="CH">Switzerland</option>
																			<option value="SY">Syrian Arab Republic</option>
																			<option value="TW">Taiwan, Province of China</option>
																			<option value="TJ">Tajikistan</option>
																			<option value="TZ">Tanzania, United Republic of</option>
																			<option value="TH">Thailand</option>
																			<option value="TL">Timor-Leste</option>
																			<option value="TG">Togo</option>
																			<option value="TK">Tokelau</option>
																			<option value="TO">Tonga</option>
																			<option value="TT">Trinidad and Tobago</option>
																			<option value="TN">Tunisia</option>
																			<option value="TR">Turkey</option>
																			<option value="TM">Turkmenistan</option>
																			<option value="TC">Turks and Caicos Islands</option>
																			<option value="TV">Tuvalu</option>
																			<option value="UG">Uganda</option>
																			<option value="UA">Ukraine</option>
																			<option value="AE">United Arab Emirates</option>
																			<option value="GB">United Kingdom</option>
																			<option value="US">United States</option>
																			<option value="UM">United States Minor Outlying Islands</option>
																			<option value="UY">Uruguay</option>
																			<option value="UZ">Uzbekistan</option>
																			<option value="VU">Vanuatu</option>
																			<option value="VE">Venezuela, Bolivarian Republic of</option>
																			<option value="VN">Viet Nam</option>
																			<option value="VG">Virgin Islands, British</option>
																			<option value="VI">Virgin Islands, U.S.</option>
																			<option value="WF">Wallis and Futuna</option>
																			<option value="EH">Western Sahara</option>
																			<option value="YE">Yemen</option>
																			<option value="ZM">Zambia</option>
																			<option value="ZW">Zimbabwe</option>
																		</select>
																	</div>
																	<!--end::Select-->
																</div>
															</div>
														</div>
														<!--end: Wizard Step 1-->
														<!--begin: Wizard Step 2-->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">Enter the Details of your Delivery</h4>
															<!--begin::Input-->
															<div class="form-group">
																<label>Package Details</label>
																<input type="text" class="form-control" name="package" placeholder="Package Details" value="Complete Workstation (Monitor, Computer, Keyboard &amp; Mouse)" />
																<span class="form-text text-muted">Please enter your Pakcage Details.</span>
															</div>
															<!--end::Input-->
															<!--begin::Input-->
															<div class="form-group">
																<label>Package Weight in KG</label>
																<input type="text" class="form-control" name="weight" placeholder="Package Weight" value="25" />
																<span class="form-text text-muted">Please enter your Package Weight in KG.</span>
															</div>
															<!--end::Input-->
															<div class="form-text">Package Dimensions</div>
															<div class="row">
																<div class="col-xl-4">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>Package Width in CM</label>
																		<input type="text" class="form-control" name="width" placeholder="Package Width" value="110" />
																		<span class="form-text text-muted">Please enter your Package Width in CM.</span>
																	</div>
																	<!--end::Input-->
																</div>
																<div class="col-xl-4">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>Package Height in CM</label>
																		<input type="text" class="form-control" name="height" placeholder="Package Height" value="90" />
																		<span class="form-text text-muted">Please enter your Package Height in CM.</span>
																	</div>
																	<!--end::Input-->
																</div>
																<div class="col-xl-4">
																	<!--begin::Input-->
																	<div class="form-group">
																		<label>Package Length in CM</label>
																		<input type="text" class="form-control" name="packagelength" placeholder="Package Length" value="150" />
																		<span class="form-text text-muted">Please enter your Package Length in CM.</span>
																	</div>
																	<!--end::Input-->
																</div>
															</div>
														</div>
														<!--end: Wizard Step 2-->
														<!--begin: Wizard Step 3-->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">Select your Services</h4>
															<!--begin::Select-->
															<div class="form-group">
																<label>Delivery Type</label>
																<select name="delivery" class="form-control">
																	<option value="">Select a Service Type Option</option>
																	<option value="overnight" selected="selected">Overnight Delivery (within 48 hours)</option>
																	<option value="express">Express Delivery (within 5 working days)</option>
																	<option value="basic">Basic Delivery (within 5 - 10 working days)</option>
																</select>
															</div>
															<!--end::Select-->
															<!--begin::Select-->
															<div class="form-group">
																<label>Packaging Type</label>
																<select name="packaging" class="form-control">
																	<option value="">Select a Packaging Type Option</option>
																	<option value="regular" selected="selected">Regular Packaging</option>
																	<option value="oversized">Oversized Packaging</option>
																	<option value="fragile">Fragile Packaging</option>
																	<option value="frozen">Frozen Packaging</option>
																</select>
															</div>
															<!--end::Select-->
															<!--begin::Select-->
															<div class="form-group">
																<label>Preferred Delivery Window</label>
																<select name="preferreddelivery" class="form-control">
																	<option value="">Select a Preferred Delivery Option</option>
																	<option value="morning" selected="selected">Morning Delivery (8:00AM - 11:00AM)</option>
																	<option value="afternoon">Afternoon Delivery (11:00AM - 3:00PM)</option>
																	<option value="evening">Evening Delivery (3:00PM - 7:00PM)</option>
																</select>
															</div>
															<!--end::Select-->
														</div>
														<!--end: Wizard Step 3-->
														<!--begin: Wizard Step 4-->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">Setup Your Delivery Location</h4>
															<div class="my-5">
																<!--begin::Input-->
																<div class="form-group">
																	<label>Address Line 1</label>
																	<input type="text" class="form-control" name="locaddress1" placeholder="Address Line 1" value="Address Line 1" />
																	<span class="form-text text-muted">Please enter your Address.</span>
																</div>
																<!--end::Input-->
																<!--begin::Input-->
																<div class="form-group">
																	<label>Address Line 2</label>
																	<input type="text" class="form-control" name="locaddress2" placeholder="Address Line 2" value="Address Line 2" />
																	<span class="form-text text-muted">Please enter your Address.</span>
																</div>
																<!--end::Input-->
																<div class="row">
																	<div class="col-xl-6">
																		<!--begin::Input-->
																		<div class="form-group">
																			<label>Postcode</label>
																			<input type="text" class="form-control" name="locpostcode" placeholder="Postcode" value="3072" />
																			<span class="form-text text-muted">Please enter your Postcode.</span>
																		</div>
																		<!--end::Input-->
																	</div>
																	<div class="col-xl-6">
																		<!--begin::Input-->
																		<div class="form-group">
																			<label>City</label>
																			<input type="text" class="form-control" name="loccity" placeholder="City" value="Preston" />
																			<span class="form-text text-muted">Please enter your City.</span>
																		</div>
																		<!--end::Input-->
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<!--begin::Input-->
																		<div class="form-group">
																			<label>State</label>
																			<input type="text" class="form-control" name="locstate" placeholder="State" value="VIC" />
																			<span class="form-text text-muted">Please enter your State.</span>
																		</div>
																		<!--end::Input-->
																	</div>
																	<div class="col-xl-6">
																		<!--begin::Select-->
																		<div class="form-group">
																			<label>Country</label>
																			<select name="loccountry" class="form-control">
																				<option value="">Select</option>
																				<option value="AF">Afghanistan</option>
																				<option value="AX">Åland Islands</option>
																				<option value="AL">Albania</option>
																				<option value="DZ">Algeria</option>
																				<option value="AS">American Samoa</option>
																				<option value="AD">Andorra</option>
																				<option value="AO">Angola</option>
																				<option value="AI">Anguilla</option>
																				<option value="AQ">Antarctica</option>
																				<option value="AG">Antigua and Barbuda</option>
																				<option value="AR">Argentina</option>
																				<option value="AM">Armenia</option>
																				<option value="AW">Aruba</option>
																				<option value="AU" selected="selected">Australia</option>
																				<option value="AT">Austria</option>
																				<option value="AZ">Azerbaijan</option>
																				<option value="BS">Bahamas</option>
																				<option value="BH">Bahrain</option>
																				<option value="BD">Bangladesh</option>
																				<option value="BB">Barbados</option>
																				<option value="BY">Belarus</option>
																				<option value="BE">Belgium</option>
																				<option value="BZ">Belize</option>
																				<option value="BJ">Benin</option>
																				<option value="BM">Bermuda</option>
																				<option value="BT">Bhutan</option>
																				<option value="BO">Bolivia, Plurinational State of</option>
																				<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
																				<option value="BA">Bosnia and Herzegovina</option>
																				<option value="BW">Botswana</option>
																				<option value="BV">Bouvet Island</option>
																				<option value="BR">Brazil</option>
																				<option value="IO">British Indian Ocean Territory</option>
																				<option value="BN">Brunei Darussalam</option>
																				<option value="BG">Bulgaria</option>
																				<option value="BF">Burkina Faso</option>
																				<option value="BI">Burundi</option>
																				<option value="KH">Cambodia</option>
																				<option value="CM">Cameroon</option>
																				<option value="CA">Canada</option>
																				<option value="CV">Cape Verde</option>
																				<option value="KY">Cayman Islands</option>
																				<option value="CF">Central African Republic</option>
																				<option value="TD">Chad</option>
																				<option value="CL">Chile</option>
																				<option value="CN">China</option>
																				<option value="CX">Christmas Island</option>
																				<option value="CC">Cocos (Keeling) Islands</option>
																				<option value="CO">Colombia</option>
																				<option value="KM">Comoros</option>
																				<option value="CG">Congo</option>
																				<option value="CD">Congo, the Democratic Republic of the</option>
																				<option value="CK">Cook Islands</option>
																				<option value="CR">Costa Rica</option>
																				<option value="CI">Côte d'Ivoire</option>
																				<option value="HR">Croatia</option>
																				<option value="CU">Cuba</option>
																				<option value="CW">Curaçao</option>
																				<option value="CY">Cyprus</option>
																				<option value="CZ">Czech Republic</option>
																				<option value="DK">Denmark</option>
																				<option value="DJ">Djibouti</option>
																				<option value="DM">Dominica</option>
																				<option value="DO">Dominican Republic</option>
																				<option value="EC">Ecuador</option>
																				<option value="EG">Egypt</option>
																				<option value="SV">El Salvador</option>
																				<option value="GQ">Equatorial Guinea</option>
																				<option value="ER">Eritrea</option>
																				<option value="EE">Estonia</option>
																				<option value="ET">Ethiopia</option>
																				<option value="FK">Falkland Islands (Malvinas)</option>
																				<option value="FO">Faroe Islands</option>
																				<option value="FJ">Fiji</option>
																				<option value="FI">Finland</option>
																				<option value="FR">France</option>
																				<option value="GF">French Guiana</option>
																				<option value="PF">French Polynesia</option>
																				<option value="TF">French Southern Territories</option>
																				<option value="GA">Gabon</option>
																				<option value="GM">Gambia</option>
																				<option value="GE">Georgia</option>
																				<option value="DE">Germany</option>
																				<option value="GH">Ghana</option>
																				<option value="GI">Gibraltar</option>
																				<option value="GR">Greece</option>
																				<option value="GL">Greenland</option>
																				<option value="GD">Grenada</option>
																				<option value="GP">Guadeloupe</option>
																				<option value="GU">Guam</option>
																				<option value="GT">Guatemala</option>
																				<option value="GG">Guernsey</option>
																				<option value="GN">Guinea</option>
																				<option value="GW">Guinea-Bissau</option>
																				<option value="GY">Guyana</option>
																				<option value="HT">Haiti</option>
																				<option value="HM">Heard Island and McDonald Islands</option>
																				<option value="VA">Holy See (Vatican City State)</option>
																				<option value="HN">Honduras</option>
																				<option value="HK">Hong Kong</option>
																				<option value="HU">Hungary</option>
																				<option value="IS">Iceland</option>
																				<option value="IN">India</option>
																				<option value="ID">Indonesia</option>
																				<option value="IR">Iran, Islamic Republic of</option>
																				<option value="IQ">Iraq</option>
																				<option value="IE">Ireland</option>
																				<option value="IM">Isle of Man</option>
																				<option value="IL">Israel</option>
																				<option value="IT">Italy</option>
																				<option value="JM">Jamaica</option>
																				<option value="JP">Japan</option>
																				<option value="JE">Jersey</option>
																				<option value="JO">Jordan</option>
																				<option value="KZ">Kazakhstan</option>
																				<option value="KE">Kenya</option>
																				<option value="KI">Kiribati</option>
																				<option value="KP">Korea, Democratic People's Republic of</option>
																				<option value="KR">Korea, Republic of</option>
																				<option value="KW">Kuwait</option>
																				<option value="KG">Kyrgyzstan</option>
																				<option value="LA">Lao People's Democratic Republic</option>
																				<option value="LV">Latvia</option>
																				<option value="LB">Lebanon</option>
																				<option value="LS">Lesotho</option>
																				<option value="LR">Liberia</option>
																				<option value="LY">Libya</option>
																				<option value="LI">Liechtenstein</option>
																				<option value="LT">Lithuania</option>
																				<option value="LU">Luxembourg</option>
																				<option value="MO">Macao</option>
																				<option value="MK">Macedonia, the former Yugoslav Republic of</option>
																				<option value="MG">Madagascar</option>
																				<option value="MW">Malawi</option>
																				<option value="MY">Malaysia</option>
																				<option value="MV">Maldives</option>
																				<option value="ML">Mali</option>
																				<option value="MT">Malta</option>
																				<option value="MH">Marshall Islands</option>
																				<option value="MQ">Martinique</option>
																				<option value="MR">Mauritania</option>
																				<option value="MU">Mauritius</option>
																				<option value="YT">Mayotte</option>
																				<option value="MX">Mexico</option>
																				<option value="FM">Micronesia, Federated States of</option>
																				<option value="MD">Moldova, Republic of</option>
																				<option value="MC">Monaco</option>
																				<option value="MN">Mongolia</option>
																				<option value="ME">Montenegro</option>
																				<option value="MS">Montserrat</option>
																				<option value="MA">Morocco</option>
																				<option value="MZ">Mozambique</option>
																				<option value="MM">Myanmar</option>
																				<option value="NA">Namibia</option>
																				<option value="NR">Nauru</option>
																				<option value="NP">Nepal</option>
																				<option value="NL">Netherlands</option>
																				<option value="NC">New Caledonia</option>
																				<option value="NZ">New Zealand</option>
																				<option value="NI">Nicaragua</option>
																				<option value="NE">Niger</option>
																				<option value="NG">Nigeria</option>
																				<option value="NU">Niue</option>
																				<option value="NF">Norfolk Island</option>
																				<option value="MP">Northern Mariana Islands</option>
																				<option value="NO">Norway</option>
																				<option value="OM">Oman</option>
																				<option value="PK">Pakistan</option>
																				<option value="PW">Palau</option>
																				<option value="PS">Palestinian Territory, Occupied</option>
																				<option value="PA">Panama</option>
																				<option value="PG">Papua New Guinea</option>
																				<option value="PY">Paraguay</option>
																				<option value="PE">Peru</option>
																				<option value="PH">Philippines</option>
																				<option value="PN">Pitcairn</option>
																				<option value="PL">Poland</option>
																				<option value="PT">Portugal</option>
																				<option value="PR">Puerto Rico</option>
																				<option value="QA">Qatar</option>
																				<option value="RE">Réunion</option>
																				<option value="RO">Romania</option>
																				<option value="RU">Russian Federation</option>
																				<option value="RW">Rwanda</option>
																				<option value="BL">Saint Barthélemy</option>
																				<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
																				<option value="KN">Saint Kitts and Nevis</option>
																				<option value="LC">Saint Lucia</option>
																				<option value="MF">Saint Martin (French part)</option>
																				<option value="PM">Saint Pierre and Miquelon</option>
																				<option value="VC">Saint Vincent and the Grenadines</option>
																				<option value="WS">Samoa</option>
																				<option value="SM">San Marino</option>
																				<option value="ST">Sao Tome and Principe</option>
																				<option value="SA">Saudi Arabia</option>
																				<option value="SN">Senegal</option>
																				<option value="RS">Serbia</option>
																				<option value="SC">Seychelles</option>
																				<option value="SL">Sierra Leone</option>
																				<option value="SG">Singapore</option>
																				<option value="SX">Sint Maarten (Dutch part)</option>
																				<option value="SK">Slovakia</option>
																				<option value="SI">Slovenia</option>
																				<option value="SB">Solomon Islands</option>
																				<option value="SO">Somalia</option>
																				<option value="ZA">South Africa</option>
																				<option value="GS">South Georgia and the South Sandwich Islands</option>
																				<option value="SS">South Sudan</option>
																				<option value="ES">Spain</option>
																				<option value="LK">Sri Lanka</option>
																				<option value="SD">Sudan</option>
																				<option value="SR">Suriname</option>
																				<option value="SJ">Svalbard and Jan Mayen</option>
																				<option value="SZ">Swaziland</option>
																				<option value="SE">Sweden</option>
																				<option value="CH">Switzerland</option>
																				<option value="SY">Syrian Arab Republic</option>
																				<option value="TW">Taiwan, Province of China</option>
																				<option value="TJ">Tajikistan</option>
																				<option value="TZ">Tanzania, United Republic of</option>
																				<option value="TH">Thailand</option>
																				<option value="TL">Timor-Leste</option>
																				<option value="TG">Togo</option>
																				<option value="TK">Tokelau</option>
																				<option value="TO">Tonga</option>
																				<option value="TT">Trinidad and Tobago</option>
																				<option value="TN">Tunisia</option>
																				<option value="TR">Turkey</option>
																				<option value="TM">Turkmenistan</option>
																				<option value="TC">Turks and Caicos Islands</option>
																				<option value="TV">Tuvalu</option>
																				<option value="UG">Uganda</option>
																				<option value="UA">Ukraine</option>
																				<option value="AE">United Arab Emirates</option>
																				<option value="GB">United Kingdom</option>
																				<option value="US">United States</option>
																				<option value="UM">United States Minor Outlying Islands</option>
																				<option value="UY">Uruguay</option>
																				<option value="UZ">Uzbekistan</option>
																				<option value="VU">Vanuatu</option>
																				<option value="VE">Venezuela, Bolivarian Republic of</option>
																				<option value="VN">Viet Nam</option>
																				<option value="VG">Virgin Islands, British</option>
																				<option value="VI">Virgin Islands, U.S.</option>
																				<option value="WF">Wallis and Futuna</option>
																				<option value="EH">Western Sahara</option>
																				<option value="YE">Yemen</option>
																				<option value="ZM">Zambia</option>
																				<option value="ZW">Zimbabwe</option>
																			</select>
																		</div>
																		<!--end::Select-->
																	</div>
																</div>
															</div>
														</div>
														<!--end: Wizard Step 4-->
														<!--begin: Wizard Actions-->
														<div class="d-flex justify-content-between border-top mt-5 pt-10">
															<div class="mr-2">
																<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
															</div>
															<div>
																<button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
																<button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
															</div>
														</div>
														<!--end: Wizard Actions-->
													</form>
													<!--end: Wizard Form-->
												</div>
											</div>
											<!--end: Wizard Body-->
										</div>
										<!--end: Wizard-->
									</div>
								</div>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->



@endsection

@section('scripts')
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->image)
                var file = {!! json_encode($user->image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection

