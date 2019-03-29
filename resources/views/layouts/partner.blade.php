<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> @yield('title')</title>
<!-- Scripts -->
<!--<script src="{{ asset('js/app.js') }}" defer></script>-->
<link rel="icon" type="image/ico" href="{{ asset('images/favicon.ico') }}"/>
<link href="{{ asset('css/wickedpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('css/kidwedo.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
</head>
@if(Auth::user())
	@php
 					$unread_messages = DB::table('messages')
											->where('to_user_id','=',Auth::user()->id)
											->where('IsReadMessage','=','N')
											->get();
	
	@endphp
@endif
<body>
		<div class="outer">
			<!--navbar-->
			<section class="nav-outer container-fluid nav-border">
				<div class="container">
				<nav class="navbar navbar-expand-lg navbar-light p-0">
				  <a class="navbar-brand" href="{{ route('plans') }}"><img src="{{ asset('images/white-logo.png') }}" class="img-fluid logo"></a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav kid-menu mr-auto">
				      
				     
				    </ul>
				   <ul class="navbar-nav kid-menu right-menu">
					@if(auth()->user() == null)
						@if(!(request()->is('partner/login')))
							<li class="nav-item Highlight-menu">
					    		<a class="nav-link" href="{{ route('partnerlogin') }}"><i class="fas fa-sign-in-alt login-icon"></i>LOG IN</a>
							</li>
						@endif
						@if(!(request()->is('partner/registration')))
							<li class="nav-item Highlight-menu">
								<a class="nav-link" href="{{ route('partnerregistration') }}">ANMELDEN</a>
							</li>
						@endif
					@endif
				  @if(auth()->user() != null)
					<li class="nav-item menus">
					    <a class="nav-link" href="{{ route('partnerhome') }}">MEINE ANGEBOTE</a><!-- My Activities -->
					</li>
					<li class="nav-item menus">
					    <a class="nav-link" href="{{ route('partner.booked') }}">GEBUCHT</a><!-- Booked Activities -->
					</li>
							<li class="nav-item Highlight-menu dropdown my-account">
				     	 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>MEIN PROFIL<!-- My Profile --></a>
				     	  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					          <a class="dropdown-item" href="{{ route('partner_account_settings') }}">Kontoeinstellugen</a><!-- Account Settings -->
										<a class="dropdown-item" href="{{ route('partner_profile') }}">Mein profil</a><!-- Profile -->
										<a class="dropdown-item" href="{{ route('partner_credits') }}">Credits</a><!-- Credits -->
										<a class="dropdown-item" href="{{ route('partner_messages.view') }}">Nachrichten @if(count($unread_messages) > 0)<span class="msg-notification">{{ count($unread_messages) }}</span>@endif</a><!-- Message -->
										<a class="dropdown-item" href="{{ route('logout') }}"class="nav-link"
                                                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     Ausloggen <!-- Logout -->
                                        </a>
																				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
																				</form>
					        </div>
				      </li>
							@endif
						</ul>
				  </div>
				</nav>
			</div>
			</section>
			<!--navabar-end-->
			<!--<section class="container-fluid bar-head text-center">
				<h5>Dein gutscheincode wurde akzeptiert</h5>
			</section>-->
            @yield('content')
			<!--footer-->
			<section class="container-fluid footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-6">
							<h4>UNTERNEHMEN</h4>
							<ul class="footer-links mb-20">
								<li><a href="{{ route('about') }}">Über Uns</a></li>
								<li><a href="{{ route('our_team') }}">Team</a></li>
								<li><a href="{{ route('career') }}">Karriere</a></li>
								<li><a href="">Blog</a></li>
								<li><a href="">Folge uns auf</a></li>
							</ul>
							
							<ul class="footer-links social-links">
								<li><a href="https://www.facebook.com/kidwedo"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://www.instagram.com/kidwedo/"><i class="fab fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="col-lg-4 col-sm-6">
							<h4>ANBIETER WERDEN</h4>
							<ul class="footer-links">
								<li><a href="{{ route('private_provider') }}">Private Anbieter</a></li>
								<li><a href="{{ route('commercial_provider') }}">Gewerbliche Anbieter</a></li>
								
							</ul>
						</div>
						<div class="col-lg-4 col-sm-6 contact">
							<h4>SERVICES</h4>
							<ul class="footer-links mb-20">
								<li><a href="">Support</a></li>
								<li><a href="{{ route('contact_us') }}">Kontakt</a></li>
								<li><a href="">Impressum</a></li>
								<li><a href="{{ route('privacy_policy') }}">Datenschutz/AGB</a></li>
								
							</ul>
						</div>
						
					</div>
					<div class="row">
						<div class="col-lg-12 text-center">
							<hr class="footer-line">
							<span class="copy-right">&copy; Kidwedo UG</span>
						</div>
					</div>
				</div>
			</section>
			<!--footer-end-->
			@include('cookieConsent::index')
</div><!--outer-end-->

<script src="{{ asset('js/popper.min.2019.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
$(document).ready(function()
		{
			$("#hide_cookie_popup").on( "click", function()
			{
				$("#cookie_popup").hide();
			});
			
			$(".filter-icon").on( "click", function()
			{
				$(this).parents(':eq(1)').find(".filter-checkbox-outer").slideToggle();
				$(this).parent().find(".fa-chevron-down").toggleClass("fa-chevron-up");
			});
		});
		</script>
</body>
</html>