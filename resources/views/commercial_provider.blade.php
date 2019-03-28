@extends($template)

@section('content')
<!--BANNER-contents-->
<section class="container-fluid pro-banner">
				<div class="container">
					<div class="pro-banner-text">
						
							<h2>Neue Kunden erreichen mit Kidwedo!</h2>
							<p>Gewinne neue Kunden mit höherer Markenbekanntheit und ohne Vorlaufkosten.</p>
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
								<span class="pro-icons"><img src="images/pro-icon-7.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Nur Spots füllen, die benötigt werden</h5>
									<p>Verdiene mehr, indem du die ungenutzten Plätze füllst. Du wählst selbst aus, welche Kurse
									und wie viele Plätze du anbieten möchtest.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-8.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Markenbekanntheit steigern</h5>
									<p>Präsentiere dich bestmöglich mit deinem Angebot und deinem Unternehmen und erreiche
									so viele neue Kunden.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-9.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Einfache und professionelle Technologie</h5>
									<p>Kidwedo bietet Online-Registrierung, Terminplanung und Zahlungen, um deine
									Geschäftsabläufe zu vereinfachen. Die
									Darstellung ist für alle Endgeräte, z.B. Smartphones, optimiert.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flex p-15 we-sprt-list">
							<div class="pro-ion-outer">
								<span class="pro-icons"><img src="images/pro-icon-4.png" class="img-fluid"></span>
							</div>
							<div class="support-des">
								<div>
									<h5>Vertrauen aufbauen und Sicherheit bieten</h5>
									<p>Bewertungen von Kunden erhalten und so größeres Vertrauen schaffen. Bewertungen
									machen Kunden Lust, es selbst einmal auszuprobieren.</p>
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
									<p>Du bekommst alle Kundeninformationen auf einen Blick. Buchungen, Nachrichten,
									Erinnerungen und Bewertungen. Dies spart nicht nur Zeit, sondern auch zusätzliches
									Personal.</p>
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
									<p>Auf Wunsch übernehmen wir kostenlos deinen Kundenservice. Wir haben immer ein offenes
									Ohr für deine Kunden und Helfen bei allen Schwierigkeiten weiter.</p>
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