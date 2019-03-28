@extends($template)

@section('content')
<!--message-view-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				<div class="activity-view my-messages mb-20 w-100 jobs-outer">
					<h5>JOBS</h5>
					<div class="row p-15 msg-list">
						<div class="col-lg-12 about-job">
							<h6>Du willst wirklich etwas bewirken? Kidwedo gibt dir die Chance dazu!</h6>
							<h4>WAS WIR BIETEN</h4>
							<ul>
								<li>Flexible Arbeitszeiten und Homeoffice</li>
								<li>Start-Up Feeling</li>
								<li>Modernstes Equipment</li>
								<li>Die besten Kollegen der Welt</li>
								<li>Top-Bezahlung</li>
								<li>eigenverantwortliche Tätigkeit in einer inspirierenden Unternehmenskultur, die auf
								Teamgeist und Leidenschaft aufbaut</li>
								<li>zahlreiche Weiterbildungsangebote und Teamevents</li>
							</ul>
							<p>Wenn du Lust hast, dich selbst weiterzuentwickeln, ein Unternehmen mitzugestalten und die
							Kinder-Freizeit-Branche zu revolutionieren, dann bist du bei uns genau richtig. Wir sind auf
							der Suche nach Experten und Talenten, die uns dabei unterstützen, unseren Kunden
							einmalige Erlebnisse und Kindheitserinnerungen zu ermöglichen und unseren Anbieter
							helfen sich selbst im Leben zu verwirklichen.</p>
							<p>Du kannst dir vorstellen, in unserem Team deinen beruflichen Traum zu leben? Dann schau
							doch mal bei unseren Stellenanzeigen vorbei, ob auch für dich der passende Job dabei ist!
							Unsere CEO, Nicol Nestmann, gibt dir dann einen tieferen Einblick und erklärt dir, welche
							spannenden Herausforderungen in Zukunft auf dich warten könnten.</p>
							<a href="{{ route('career_lists') }}"><button type="button" class="kid-btn kid-small-btn">FREIE STELLEN</button></a>
						</div>
					</div>
				</div>
				</div>
			</section>
            <!--message-view-contents end-->
            @endsection