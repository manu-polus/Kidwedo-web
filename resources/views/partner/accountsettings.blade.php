@extends('layouts.partner')
@section('title')
Settings
@endsection
@section('content')
        <!--PROFILE-contents-->
			<section class="container-fluid register-bg">
				<div class="container">
				<div class="register-outer subscribe p-0 mb-20">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12 profile-outer account-setting">
									<h5>KONTOEINSTELLUGEN</h5>
									<h6>Paswort andern</h6>
									<form method="POST" action="{{ route('partner_passwordreset') }}">
                        			@csrf
									<div class="prof-form account-form">
										
										<div class="form-group row">
											<div class="col-lg-4 col-sm-6">
												Bisheriges Paswort
											</div>
											<div class="col-lg-8 col-sm-6">
												<input type="password" name="password" class="custom-input" placeholder="Bisheriges Paswort" required>
												@if (Session::get('error'))
                        							<span class="invalid" role="alert">
                              							<strong>{{ Session::get('error') }}</strong>
                          							</span>
													<?php Session::forget('error'); ?>
                        						@endif
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-4 col-sm-6">
												Neues Paswort
											</div>
											<div class="col-lg-8 col-sm-6">
												<input type="password" name="new_password" class="custom-input" placeholder="Neues Paswort" required>
												@if ($errors->has('new_password'))
                          							<span class="invalid" role="alert">
                              							<strong>{{ $errors->first('new_password') }}</strong>
                          							</span>
                        						@endif
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-4 col-sm-6">
												Paswort Beastatigen
											</div>
											<div class="col-lg-8 col-sm-6">
												<input type="password" name="new_password_confirmation" class="custom-input" placeholder="Paswort Beastatigen" required>
											</div>
										</div>
										<div class="form-group text-center m-0">
											<button type="submit" class="kid-btn w-170">Aktualisieren</button>
										</div>
									</div>
									</form>
									<div class="check-box w-100 text-center mb-40 prl-15">
										<div class="form-check">
										  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
										  <label class="form-check-label" for="defaultCheck1">
										   La mochte uber Neuingkeiten per E-mail informiert werden
										  </label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				</div>
			</section>
            <!--PROFILE-contents end-->
            @endsection