@extends('layouts.template')
@section('title')
Register
@endsection
@section('content')

<!--register-contents-->
<section class="container-fluid register-bg">
	<div class="container">
		<div class="register-outer">
			<div class="row">
				<div class="col-lg-12 text-center mb-20">
					<h2>ERSTELE DIR KIN KONTO</h2>
				</div>
				<div class="col-lg-12">
						<div class="login-subouter">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group text-center">
                                    <a href="{{url('/redirect')}}"><button type="button" class="fb-link-btn w-100"><i class="fab fa-facebook-f"></i> LOG IN MIT FACEBOOK</button></a>
										<small class="or">ODER</small>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <input type="hidden" value="3" name="type">
								        <div class="form-group">
                                            <input type="text" class="custom-input" placeholder="Vorrname" name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
								        </div>
								        <div class="form-group">
                                            <input type="text" class="custom-input" placeholder="Nachname" name="surname" value="{{ old('surname') }}">
                                            @if ($errors->has('surname'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
								        <div class="form-group">
									        <input type="email" class="custom-input" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="custom-input" placeholder="Telefonnumber" name="phone" value="{{ old('phone') }}" required>
                                            @if ($errors->has('phone'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
								        <div class="form-group">
									        <input type="password" class="custom-input" placeholder="paswort" name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
								        <div class="form-group">
									        <button type="submit" class="kid-btn w-100">ANMELDEN</button>
                                        </div>
                                    </form>
								    <div class="form-group register-dis">
									    <p>Durch die Anmeldung bei kidwedo stimmen sie
										    unseren <a href="">Nutzungsbedingungen</a> und <a href="">Datenschutzbestimmungen</a> zu
									    </p>
								    </div>
								    <div class="form-group text-center">
									    <p>Du hast bereits ein konto?</p>
									    <a href="{{ route('login') }}"><button type="button" class="kid-btn login--btn w-100">LOGIN</button></a>
								    </div>
							    </div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
<!--register-contents end-->
@endsection