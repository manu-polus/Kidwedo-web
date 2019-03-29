@extends($template)

@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css'>

<!--BANNER-contents-->
<section class="container-fluid pro-banner pri-pro">
				<div class="container">
					<div class="pro-banner-text">
						<h2>Du hast ein Hobby oder eine Leidenschaft und würdest gern damit Geld verdienen?</h2>
						@if(Auth::user() == null)<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn">Jetzt Anbieter werden!</button></a>@endif
					</div>
				</div>
			</section>
			<!--BANNER-contents end-->

			<!--pro-steps start-->
			<section class="container-fluid pro-steps bg-color-2">
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
								<li>Angebot planen und inserieren</li>
								<li>Buchungen erhalten und verwalten</li>
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
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-1.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Verdiene mit deinem Hobby Geld</h5>
									<p>Baue dir nebenberuflich deine Selbstständigkeit auf oder mache dein Hobby zum Beruf.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-2.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Begeistere Kinder mit deinem Angebot</h5>
									<p>Mit einem detaillierten Leitfaden, geben wir dir das Handwerkszeug mit, ein Angebot zu erstellen,
										 welches Kinder und Eltern begeistert.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-3.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Erhalte wichtiges Feedback</h5>
									<p>Erhalte im Anschluss an dein Erlebnis 
										Feedback und Bewertungen deiner Kunden und passe dein Angebot an ihre Bedürfnisse an. </p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-4.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Überzeuge durch Sicherheit</h5>
									<p>Gewinne das Vertrauen deiner Kunden durch unsere Sicherheitszertifizierungen.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-5.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Spare Zeit, Geld und Energie</h5>
									<p>Mit unserem einfachen Buchungs- und Zahlungssystem übernehmen wir die Arbeit
										 für dich und du kannst dich auf deine Leidenschaft konzentrieren.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons bg-color-1"><img src="images/pro-icon-6.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Genieße fantastischen Service</h5>
									<p>Wir sind stehst für dich da und beantworten die alle Fragen 
										schnellstmöglich. </p>
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
					<p class="color-2">Registriere dich jetzt kostenlos und unverbindlich als Anbieter und starte 
						durch! Dasgesamte Angebot von Kidwedo ist für Anbieter kostenfrei!</p>
						@if(Auth::user() == null)<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn kid-small-btn">Jetzt Anbieter Werden</button></a>@endif
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