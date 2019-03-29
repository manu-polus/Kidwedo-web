@extends('layouts.template')
@section('title')
Login
@endsection
@section('content')
@if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
@endif

<!--login-contents-->
<section class="container-fluid login-banner">
	<div class="container">
	@if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
    <?php Session::forget('success'); ?>
    @endif
		<div class="login-outer">
			<div class="row">
				<div class="col-lg-12 text-center mb-20">
					<h2>{{ __('MITGLIEDER LOGIN') }}</h2>
				</div>
				<div class="col-lg-12">
					<div class="login-subouter">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group text-center">
									<a href="{{url('/redirect')}}"><button type="button" class="fb-link-btn w-100"><i class="fab fa-facebook-f"></i> Mit Facebook einloggen</button></a>
									<small class="or">ODER</small>
								</div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
								    <div class="form-group">
									    <input type="text" name="email" class="custom-input" placeholder="{{ __('E-Mail') }}" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								    <div class="form-group">
									    <input type="password" class="custom-input" placeholder="{{ __('Passwort') }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								    <div class="form-group form-check">
									    <input class="form-check-input" type="checkbox" name="remember" id="defaultCheck1" {{ old('remember') ? 'checked' : '' }}>
									    <label class="form-check-label" for="defaultCheck1">
									    {{ __('Erinnere dich an mich') }}
									    </label>
								    </div>
								    <div class="form-group">
									    <button type="submit" class="kid-btn w-100">{{ __('Anmeldung') }}</button>
								    </div>
								    <div class="form-group forgot-password">
									    <a href="{{ route('password.request') }}">Passwort vergessen ?</a>
								    </div>
                                </form>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
<!--login-contents end-->
@endsection