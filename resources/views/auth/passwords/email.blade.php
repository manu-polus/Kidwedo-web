@extends('layouts.template')

@section('content')
<!--PROFILE-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				<div class="register-outer subscribe p-0 mb-20">
					<div class="row">
						
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12 profile-outer account-setting">
									<h5>Forgot Paswort</h5>
								
									
										
										<form class="form-group row p-15" method="POST" action="{{ route('password.email') }}">
                                        @csrf
											<div class="col-lg-4 col-sm-6">
												Forgot Paswort
                                            </div>
                                            <div class="col-lg-8 col-sm-6 mb-20">
                                                    <input id="email" type="email" class="custom-input" name="email" value="{{ $email ?? old('email') }}" placeholder="E-Mail" required autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
											    </div>
											<div class="col-lg-8  offset-md-4">
												<button type="submit" class="kid-btn kid-small-btn">Senden</button>
                                            </div>
                                        </form>
										
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				</div>
			</section>
			<!--PROFILE-contents end-->
@endsection