@extends($template)

@section('content')
<!--message-view-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				<div class="activity-view my-messages mb-20 w-100 jobs-outer">
					<h5>JOBS</h5>
					<div class="row p-15 msg-list">
						<div class="col-lg-12 listing-job">

							<h4>Customer Happiness Team</h4>
							<a href="{{ route('career_job') }}"><p>CUSTOMER HAPPINESS SPECIALIST/ MITARBEITER KUNDENSERVICE<br>
							CUSTOMER RELATIONSHIP / KUNDENBETREUER</p></a>
						</div>
						<div class="col-lg-12 listing-job">
							<h4>Executive Management</h4>
							<a href=""><p>ASSISTENT DER GESCHÄFTSLEITUNG<br>
							PRAKTIKANT BUSINESS ANALYTICS<br>
							PRAKTIKANT OPERATIONS & FINANCE</p></a>
						</div>
						<div class="col-lg-12 listing-job">
							<h4>IT</h4>
							<a href=""><p>
								ABACKEND DEVELOPER<br>
								FRONTEND DEVELOPER
							</p></a>
						</div>
						<div class="col-lg-12 listing-job">
							<h4>Marketing</h4>
							<a href=""><p>CONTENT MARKETING MANAGER<br>
							HEAD OF PERFORMANCE MARKETING<br>
							PRAKTIKANT ONLINE MARKETING<br>
							PRAKTIKANT SOCIAL MEDIA / CONTENT MARKETING</p></a>
						</div>
						<div class="col-lg-12 listing-job">
							<h4>Produkt-Management</h4>
							<a href=""><p>PRAKTIKANT PRODUKTMANAGEMENT<br>
							VERTRIEBSMITARBEITER (TELESALES) IM INNENDIENST<br>
							</p></a>
						</div>
					</div>
				</div>
				</div>
			</section>
            <!--message-view-contents end-->
            @endsection