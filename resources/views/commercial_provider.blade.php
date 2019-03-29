@extends($template)

@section('content')
<!--BANNER-contents-->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css'>
<section class="container-fluid pro-banner com-pro">
				<div class="container">
					<div class="pro-banner-text">
						
							<h2>Neue Kunden erreichen mit Kidwedo!</h2>
							<p>Gewinne neue Kunden mit höherer Markenbekanntheit und ohne Vorlaufkosten.</p>
							@if(Auth::user() == null)<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn">Jetzt Anbieter werden!</button></a>@endif
						
					</div>
				</div>
			</section>
			<!--BANNER-contents end-->

			<!--pro-steps start-->
			<section class="container-fluid pro-steps bg-color-3">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<img src="images/fox-1.png" class="img-fluid">
						</div>
						<div class="col-lg-6">
							<h4>SCHNELL UND EINFACH ZUM ERFOLG</h4>
							<ul>
								<li>Kostenfrei anmelden</li>
								<li>Profil erstellen</li>
								<li>Identität überprüfen lassen</li>
								<li>Angebot planen und einstellen</li>
								<li>Buchungen erhalten</li>
								<li>Angebot durchführen</li>
								<li>Geld und Bewertungen erhalten</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--pro-steps end-->

			<!--we-support support-->
			<section class="container-fluid we-support register-bg">
				<h4 class="text-center">WIR UNTERSTÜTZEN DICH</h4>
				<div class="container we-spprt-outer">
					<div class="row">
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-7.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Nur Spots füllen, die benötigt werden</h5>
									<p>Verdiene mehr, indem du die ungenutzten Plätze füllst. Du wählst selbst aus,
										 welche Kurse und wie viele Plätze du anbieten möchtest.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-10.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Weniger Zeit für organisatorisches</h5>
									<p>Auf Wunsch übernehmen wir kostenlos deinen Kundenservice. Wir haben immer ein offenes Ohr für 
										deine Kunden und helfen bei Schwierigkeiten weiter.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-4.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Vertrauen aufbauen </h5>
									<p>Gute Bewertungen steigern des entgegengebrachte Vertrauen deiner 
										künftigen Kunden. </p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-8.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Reichweite steigern</h5>
									<p>Präsentiere dich bestmöglich mit deinem Angebot und deinem Unternehmen und 
										erreiche so viele neue Kundensegmente.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-5.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Zeit und Energie sparen</h5>
									<p>Du bekommst alle Kundeninformationen auf einen Blick. Buchungen, Nachrichten, Erinnerungen und Bewertungen. 
									Dies spart nicht nur Zeit, sondern auch zusätzliches Personal.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-9.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Alles digital auf einen Blick</h5>
									<p>Kidwedo bietet Online-Registrierung, Terminplanung und Zahlungen, 
										um deine Geschäftsabläufe zu vereinfachen. </p>
								</div>
							</div>
						</div>
						
						
						
					</div>
				</div>
			</section>
			<!--we-support end-->
			
			<!--provider-comments slider-->
			<section class="container-fluid mb-20 p-15">
				<div class="container">
						 <section class="testimonials">
						 <h1>ANBIETER BEWERTUNGEN</h1>
						 <div class="testimonials__wrapper">
						  <blockquote>
						    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin turpis ut magna rhoncus pellentesque.</p>
						    <img src="images/rating.png" class="img-fluid">
						   <cite>Joe Doe</cite>
						  </blockquote>
						  <blockquote>
						    <p>Vestibulum molestie aliquet tincidunt. Vestibulum molestie aliquet tincidunt.</p>
						    <img src="images/rating.png" class="img-fluid">
						   <cite>Jane Doe</cite>
						  </blockquote>
						  <blockquote>
						    <p>Nunc gravida in nunc ut bibendum. Ut pulvinar egestas vestibulum. Aenean molestie lorem eget mauris tempus dapibus. Integer 
						    sollicitudin dui ut quam varius tristique.</p>
						    <img src="images/rating.png" class="img-fluid">
						   <cite>John Smith</cite>
						  </blockquote>
						  <blockquote>
						    <p>Nunc gravida in nunc ut bibendum. Ut pulvinar egestas vestibulum. Aenean molestie lorem eget mauris tempus dapibus. Integer sollicitudin dui ut quam varius tristique.</p>
						    <img src="images/rating.png" class="img-fluid">
						   <cite>Otto Normalverbraucher</cite>
						  </blockquote>
						 </div>
						</section>
				</div>
			</section>
			<!--provider-comments end-->
			<!--REG-AREA-->
			<section class="container-fluid mb-20 p-15">
				<div class="container text-center pro-reg">
					<p class="color-2">Registriere dich jetzt kostenlos und unverbindlich als 
					Anbieter und biete dein Angebot kostenfrei bei uns an. </p>
						@if(Auth::user() == null)<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn kid-small-btn">Jetzt Anbieter werden</button></a>@endif
				</div>
			</section>
			<!--REG-AREA-END-->
			
			<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'></script>
			<script>
	$('.testimonials__wrapper').slick({
  slidesToShow: 1,
  autoplay: true,
  mobileFirst: true,
  swipe: true,
  arrows: false,
  autoplaySpeed:3000,
});
</script>
@endsection