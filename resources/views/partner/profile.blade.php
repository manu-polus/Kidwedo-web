@extends('layouts.partner')
@section('title')
Profile
@endsection
@section('content')
<!--PROFILE-contents-->
            <section class="container-fluid register-bg">
            
				<div class="container">
                @if ($message = Session::get('success'))
                    <div class="w3-panel w3-green w3-display-container">
                        <span onclick="this.parentElement.style.display='none'"
    				            class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                        <p>{!! $message !!}</p>
                    </div>
                <?php Session::forget('success'); ?>
                @endif
                    <form method="POST" action="{{ route('partner_profile') }}" enctype="multipart/form-data">
                        @csrf
				        <div class="register-outer subscribe p-0 mb-20">
					        <div class="row">
						
						        <div class="col-lg-12">
							        <div class="row">
								        <div class="col-lg-12 profile-outer">
									        <h5>PROFILE</h5>
									        <div class="prof-form">
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Business Name
											        </div>
											        <div class="col-lg-8 col-sm-6">
													<input id="business_name" type="text" class="custom-input" name="business_name" value="{{ $partner->business_name }}" placeholder="Business Name" required autofocus>
                                            		@if ($errors->has('business_name'))
                                                		<span class="invalid" role="alert">
                                                    		<strong>{{ $errors->first('business_name') }}</strong>
                                                		</span>
                                            		@endif
											        </div>
												</div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Vorname
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="text" class="custom-input" placeholder="Vorrname" name="name" value="{{ Auth::user()->name }}">
                                                        @if ($errors->has('name'))
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('name') }}</strong>
                          							        </span>
                        						        @endif
											        </div>
										        </div>
										        <div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        E-Mail
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="email" class="custom-input" placeholder="E-mail" name="email" value="{{ Auth::user()->email }}" disabled>
                                                        @if ($errors->has('email'))
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('email') }}</strong>
                          							        </span>
                        						        @endif
											        </div>
												</div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Logo
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="file" placeholder="Logo" name="logo">
														@if ($errors->has('logo'))
														<br>
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('logo') }}</strong>
                          							        </span>
                        						        @endif
                                                    </div>
										        </div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Picture
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="file" placeholder="Picture" name="picture">
														@if ($errors->has('picture'))
														<br>
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('picture') }}</strong>
                          							        </span>
                        						        @endif
                                                    </div>
										        </div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        About
											        </div>
											        <div class="col-lg-8 col-sm-6">
														<textarea id="about" type="text" class="form-control" name="about" style="resize: none;" rows="5" placeholder="About business">{{ $partner->description }}</textarea>
                                            			@if ($errors->has('about'))
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('about') }}</strong>
                          							        </span>
                        						        @endif
											        </div>
										        </div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Website
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="text" class="custom-input" placeholder="Website" name="website" value="{{ $partner->website }}">
                                                    </div>
										        </div>
										        <div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Telefonnumber
											        </div>
											        <div class="col-lg-8 col-sm-6">
                                                        <input type="text" class="custom-input" placeholder="Telefonnumber" name="phone" value="{{ Auth::user()->mobile_number }}">
                                                        @if ($errors->has('phone'))
                          							        <span class="invalid" role="alert">
                              							        <strong>{{ $errors->first('phone') }}</strong>
                          							        </span>
                        						        @endif
											        </div>
										        </div>
										        <div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
														Adresse
											        </div>
											        <div class="col-lg-8 col-sm-6">
														<textarea id="address" type="text" class="form-control" name="address" style="resize: none;" rows="5" placeholder="Adresse" required>{{ Auth::user()->address }}</textarea>
                                            		</div>
												</div>
												<div class="form-group row">
											        <div class="col-lg-4 col-sm-6">
												        Zipcode
											        </div>
											        <div class="col-lg-8 col-sm-6">
													<input id="zipcode" type="text" class="custom-input" name="zipcode" value="{{ $partner->zipcode }}" placeholder="Zipcode" required>
                                            		@if ($errors->has('zipcode'))
                                                		<span class="invalid" role="alert">
                                                    		<strong>{{ $errors->first('zipcode') }}</strong>
                                                		</span>
                                            		@endif
											        </div>
										        </div>
                                            </div>
								        </div>
								
							        </div>
						        </div>
					        </div>
				        </div>
				        <div class="form-group text-center">
					        <button type="submit" class="kid-btn">Aktualisieren</button>
				        </div>
                    </form>
				</div>
			</section>
			<!--PROFILE-contents end-->
@endsection