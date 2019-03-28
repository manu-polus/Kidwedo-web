@extends($template)

@section('content')
<!--BANNER-contents-->
<section class="container-fluid pro-banner">
				<div class="container">
					<div class="pro-banner-text">
						<h2>Du hast ein Hobby oder eine Leidenschaft und würdest gern damit Geld verdienen?</h2>
						<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn">Jetzt Anbieter werden!</button></a>
					</div>
				</div>
			</section>
			<!--BANNER-contents end-->

			<!--pro-steps start-->
			<section class="container-fluid pro-steps">
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
								<span class="pro-icons"><img src="images/pro-icon-1.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Verdiene mit deinem Hobby Geld</h5>
									<p>Mach dich ganz nebenbei ohne Risiko Selbstständig und geh Schritt für Schritt in ein freieres und erfüllteres Leben.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-2.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Erstelle ein perfektes Angebot</h5>
									<p>Mit einem detaillierten Leitfaden, geben wir dir das Handwerkszeug mit, ein Angebot zu
									erstellen, welches Kinder und Eltern begeistert.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-3.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Erhalte wichtiges Feedback</h5>
									<p>Erhalte direkt nach deinem Angebot Feedback und Bewertungen. So bist du stehst am Puls
									deiner Kunden und kannst dein Angebot perfektionieren.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-4.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Biete Sicherheit für Kunden</h5>
									<p>Gewinne mehr Kunden durch unsere Sicherheitszertifizierungen.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-5.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Spare Zeit, Geld und Energie</h5>
									<p>Mit unserem einfachen Buchungs- und Zahlungssystem übernehmen wir für dich die Arbeit
									und du kannst dich auf das konzentrieren was du am besten kannst.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-6.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Genieße Fantastischen Service</h5>
									<p>Wir sind stehst für dich da und beantworten die alle Fragen schnellstmöglich. Du erreichst
									uns online oder per Telefon.</p>
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
					<p>Registriere dich jetzt kostenlos und unverbindlich als Anbieter und starte 
						durch! Dasgesamte Angebot von Kidwedo ist für Anbieter kostenfrei!</p>
						<a href="{{ route('partnerregistration') }}"><button type="button" class="kid-btn kid-small-btn">Jetzt Anbieter Werden</button></a>
				</div>
			</section>
			<!--REG-AREA-END-->
			<!--questions-AREA-->
			<section class="container-fluid p-15 any-questions">
				<div class="container text-center">
					<h5>DU HAST FRAGEN?</h5>
					<p>Sachau dir Hilfe center an oder sende uns eine E-mail<br>
					Wir sind hier, Um dir die bestmugliche Kidwedo-Erfahrung<br>
					zu bieten!</p>
						
				</div>
			</section>
			<!--questions-END-->
@endsection