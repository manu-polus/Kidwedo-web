@extends('layouts.template')

@section('title')
Home
@endsection

@section('content')
<!--BANNER-contents-->
<section class="container-fluid home-banner">
				<div class="container">
					<!-- <div class="banner-form-outer">
						<div class="row banner-contents">
							<div class="col-lg-12 text-center">
								<h1>TESTE KIDWEDO JETZT FUR €10</h1>
								<p>Buche innerhalb von 5 minuten,das beste Erlebnis in deiner Stadt</p>
							</div>
							<div class="col-lg-6 col-sm-6">
								<input type="text" class="custom-input banner-input" placeholder="username" name="">
							</div>
							<div class="col-lg-3 col-sm-6">
								<input type="text" class="custom-input banner-input" placeholder="password" name="">
							</div>
							<div class="col-lg-3 col-sm-12">
								<button type="button" class="kid-btn banner-btn w-100">STARTE JETZT</button>
							</div>
						</div>
					</div> -->
					
				</div>
			</section>
			<!--BANNER-contents end-->
		
			<section class="container-fluid home-bar text-center">
				<div class="fox-outer">
					<div class="fox-description">
						<hgroup class="speech-bubble">
							
							<h2>Buche innerhalb von 5 Minuten, das beste Erlebnis in deiner Stadt.</h2>
						</hgroup>
					</div>
					<div class="fox-img">
						<img src="images/fox-home.png" class="img-fluid">
					</div>
				</div>
				<h5><span>Teste Kidwedo jetzt einmalig für 10€     Jetzt testen!</span>@if(Auth::user() == null)<span><a href="{{ route('register') }}"><button type="button" class="kid-btn kid-small-btn  bar-btn">Jetzt testen!</button></a></span>@endif</h5>

			</section>
				<!--about-contents-->
			<section class="container-fluid home-about">
				<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<img src="images/kids.jpg" class="img-fluid">
						</div>
						<div class="col-lg-7 v-h-center">
							<div>
							<h2>Eine Plattform.
							<br>Tausende Erlebnisse.</h2>
							<p>Du mochtest mit wenig Zeitaufwand und fur moglichst kleines Geld 
                           	dein Kind beschaftigen, es fordern und einzigartige 
                           	Kindheitserinnerungen schaffen?</p>
                           	<p>Dann bist du bei Kidwedo genau richtig!</p>
                           </div>
						</div>
					</div>
				</div>
			</section>
			<!--about-contents end-->
			<!--mobile-app-contents-->
			<section class="container-fluid mobile-app">
				
					<div class="row">
						<div class="col-lg-8 v-h-center">
							<div class="mob-app-img w-100 text-center">
								<h4>SO FUNKTIONIERT ES</h4>
								<img src="images/mobile-app.png" class="img-fluid">
							</div>
						</div>
						<div class="col-lg-4 app-discription">
							<div class="row">
								<div class="col-lg-12 text-center">
									<h5>WAHLE</h5>
									<p>Suche Aktivitaten, Kurse und 
                                       Erlebnisse each Alter, 
                                     Standort und Interesse.</p>
								</div>
								<div class="col-lg-12 text-center">
									<h5>BUCHE</h5>
									<p>Finde Zeiten und Orte die am 
									   besten pasen und buche 
									            sofort.</p>
								</div>
								<div class="col-lg-12 text-center">
									<h5>ERLEBE</h5>
									<p>Erhalte deine Bestatigung 
                                     und los gehts!</p>
								</div>
							</div>
						</div>
					</div>
				
			</section>
			<!--mobile-app-contents end-->
			<!--thumbs-contents-->
			<section class="container-fluid  thumb-descrip">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-6">
							<div class="thumb-outer w-100">
								<div class="thumb-1 w-100 text-center v-h-center">
									<img src="images/thumb-1.png" class="img-fluid">
								</div>
								<div class="t-discription w-100 text-center">
									<h5>Entdecken und erleben</h5>
									<p>Finde vielfaltige und 
									spannende Aktivitaten in
									deiner Nahe und schaffe
									deinem Kind toile
									Kindheitserinnerungen.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="thumb-outer w-100">
								<div class="thumb-2 w-100 text-center v-h-center">
									<img src="images/thumb-2.png" class="img-fluid">
								</div>
								<div class="t-discription w-100 text-center">
									<h5>Zahlreiche Anbieter</h5>
									<p>Entdecke vielfaltige
									Angebote in den
									Kategorien Sport, Musik,
									Natur, Technik,
									Personlichkeit, Soziales,
									Ernahrung, Handwerk,
									Kunst, Entspannung und
									Spiel & Outdoor.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="thumb-outer w-100">
								<div class="thumb-3 w-100 text-center v-h-center">
									<img src="images/thumb-3.png" class="img-fluid">
								</div>
								<div class="t-discription w-100 text-center">
									<h5>Einfach und schnell</h5>
									<p>Du benotigst nur 5 
									Minuten, urn ein
									passendes Angebot zu
									suchen, zu buchen und
									eine Bestatigung zu
									erhalten. Kidwedo spart
									dir Zeit, Nerven und Geld!</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="thumb-outer w-100">
								<div class="thumb-4 w-100 text-center v-h-center">
									<img src="images/thumb-4.png" class="img-fluid">
								</div>
								<div class="t-discription w-100 text-center">
									<h5>Sicher und bequem</h5>
									<p> Durch Bewertungen und
									Zertifizierungen werden
									Anbieter verifiziert, damit
									 du dich entspannt
									zuriicklehnen kannst.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--thumbs-contents end-->
			<!--partner-contents-->
			<section class="container-fluid partners">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h4 class="text-center"> Wahle aus gewerblichen und privaten Anbietern aus</h4>
							<div class="slider client-slide">
							    <div class="slide"><img src="images/partner-1.jpg"></div>
								<div class="slide"><img src="images/partner-2.jpg"></div>
								<div class="slide"><img src="images/partner-3.jpg"></div>
								<div class="slide"><img src="images/partner-4.jpg"></div>
								<div class="slide"><img src="images/partner-5.jpg"></div>
								<div class="slide"><img src="images/partner-6.jpg"></div>
								<div class="slide"><img src="images/partner-7.jpg"></div>
								<div class="slide"><img src="images/partner-8.jpg"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--partner-contents end-->
			<!--list-slider-contents-->
			<section class="container-fluid inspire-slider">
					<div class="row">
						<div class="col-lg-12">
							<h4 class="text-center">LASS DICH VON ANDEREN ELTERN INSPIRIEREN</h4>
							<div class="bxslider">
							  <div class="slider-list">
							  		<img src="images/slider-1.jpg" alt="ClientName" title="ClientName1">
							  		<div class="slider-captions w-100 text-center">
							  			<h5>seoulinthecity</h5>
							  			<p>O's first time at this indoor kids
										play park and he was in play
										heaven. The adults drink
										 and eat, while the kids have
										endless fun</p>
							  		</div>
							  </div>
							   <div class="slider-list">
							  		<img src="images/slider-1.jpg" alt="ClientName" title="ClientName1">
							  		<div class="slider-captions w-100 text-center">
							  			<h5>seoulinthecity</h5>
							  			<p>O's first time at this indoor kids
										play park and he was in play
										heaven. The adults drink
										 and eat, while the kids have
										endless fun</p>
							  		</div>
							  </div>
							   <div class="slider-list">
							  		<img src="images/slider-1.jpg" alt="ClientName" title="ClientName1">
							  		<div class="slider-captions w-100 text-center">
							  			<h5>seoulinthecity</h5>
							  			<p>O's first time at this indoor kids
										play park and he was in play
										heaven. The adults drink
										 and eat, while the kids have
										endless fun</p>
							  		</div>
							  </div>
							   <div class="slider-list">
							  		<img src="images/slider-1.jpg" alt="ClientName" title="ClientName1">
							  		<div class="slider-captions w-100 text-center">
							  			<h5>seoulinthecity</h5>
							  			<p>O's first time at this indoor kids
										play park and he was in play
										heaven. The adults drink
										 and eat, while the kids have
										endless fun</p>
							  		</div>
							  </div>
							</div>
						</div>
					</div>
			</section>
			<!--list-slider-contents end-->
			<!--list-slider-contents-->
			<section class="container-fluid discover">
					<div class="row">
						<div class="col-lg-12">
							<h4>ENTDECKE UNSERE Highlights im MARZ</h4>
							<div class="discover-img-outer">
								<div class="row">
									<div class="col-lg-6 col-sm-6">
										<img src="images/discover-1.jpg" class="img-fluid">
									</div>
									<div class="col-lg-6 col-sm-6">
										<img src="images/discover-2.jpg" class="img-fluid">
									</div>
									<div class="col-lg-6 col-sm-6">
										<img src="images/discover-3.jpg" class="img-fluid">
									</div>
									<div class="col-lg-6 col-sm-6">
										<img src="images/discover-4.jpg" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					</div>
			</section>
			<!--list-slider-contents end-->
			<!--have-question-contents-->
			<section class="container-fluid have-question">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h4>DU HAST FRAGEN?</h4>
							<p> Schau dir unser Hilfe Center an oder sende uns eine E-Mail. 
                             Wir sind hier, urn dir die bestmogliche Kidwedo-Erfahrung zu bieten!</p>
						</div>
					</div>
			</section>
			<!--have-question-contents end-->
<script>
jQuery('.slider').ready(function(){
	jQuery('.slider').slick({
			 autoplay: true,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 6,
		  slidesToScroll: 4,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});
});
								
</script>
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>
@endsection