@extends('layouts.partner')

@section('title')
ANBIETER  REGISTRIERUNG
@endsection
@section('content')
<!--register-contents-->
<section class="container-fluid register-bg">
	<div class="container">
		<div class="register-outer">
			<div class="row">
				<div class="col-lg-12 text-center mb-20">
					<h2>ANBIETER  REGISTRIERUNG</h2>
				</div>
				<div class="col-lg-12">
						<div class="login-subouter">
							<div class="row">
								<div class="col-lg-12">
									<form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <input type="hidden" value="2" name="type">
                                        <div class="form-group">
                                            <input type="text" class="custom-input" placeholder="Vorname" name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
								        </div>
                                        <div class="form-group">
                                            <input id="business_name" type="text" class="custom-input" name="business_name" value="{{ old('business_name') }}" placeholder="Unternehmen" required autofocus>
                                            @if ($errors->has('business_name'))
                                                <span class="invalid" role="alert">
                                                    <strong>{{ $errors->first('business_name') }}</strong>
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
                                            <textarea id="address" type="text" class="form-control" name="address" style="resize: none;" rows="5" placeholder="Adresse">{{ old('address') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea id="about" type="text" class="form-control" name="about" style="resize: none;" rows="5" placeholder="Kurzbeschreibung des Angebotes" required>{{ old('about') }}</textarea>
                                            @if ($errors->has('about'))
                                                <span class="invalid" role="alert">
                                                    <strong>{{ $errors->first('about') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input id="website" type="text" class="custom-input" name="website" value="{{ old('website') }}" placeholder="Webseite">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="custom-input" placeholder="Telefonnummer" name="phone" value="{{ old('phone') }}" required>
                                            @if ($errors->has('phone'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input id="zipcode" type="text" class="custom-input" name="zipcode" value="{{ old('zipcode') }}" placeholder="Zipcode" required>
                                            @if ($errors->has('zipcode'))
                                                <span class="invalid" role="alert">
                                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
								        <div class="form-group">
									        <button type="submit" class="kid-btn w-100">REGISTRIEREN</button>
                                        </div>
                                    </form>
								    <div class="form-group register-dis">
									    <p>Durch die Registrierung bei Kidwedo, stimmst du unseren <a href="">Nutzungsbedingungen</a> und <a href="">Datenschutzbestimmungen</a> zu
									    </p>
								    </div>
								    <div class="form-group text-center">
									    <p>Du hast bereits ein Konto?</p>
									    <a href="{{ route('partnerlogin') }}"><button type="button" class="kid-btn login--btn w-100">LOGIN</button></a>
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