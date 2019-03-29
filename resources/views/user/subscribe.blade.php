@extends('layouts.template')
@section('title')
Subscribe
@endsection
@section('subscribe')
@if((Auth::user()->user_role_id) == 1)
<script>
    window.location.href = '/partner/dashboard';
</script>
@endif

<!--subscribe-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				@if ($message = Session::get('error'))
					{{ Session::forget('error') }}
        			<div class="w3-panel w3-red w3-display-container">
            			<span onclick="this.parentElement.style.display='none'"
    						class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            			<p>{!! $message !!}</p>
					</div>
				@endif
				<div class="register-outer subscribe p-0 mb-20">
					<div class="row">
						
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<h5>KIDWEDO ERLEBEN</h5>
									<div class="subscribe-outer w-100">
										<h6>Teste Kidwedo für 10€</h6>
										<p>Die Testversion beginnt zum Zeitpunkt des Kaufs und gilt einen Monat. Nach der Testphase verlängert sich deine Mitgliedschaft automatisch um 40€ pro Monat.
										 Du kannst deine Mitgliedschaft jederzeit kündigen. </p>
										
										
									</div>
									
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="register-outer subscribe p-0 mb-20">
					<div class="row">
						
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div class="subscribe-outer w-100 select-p">
										<h6>Vorteile der Kidwedo-Mitgliedschaft</h6>
										<ul>
											<li>Buche innerhalb von 5 Minuten die besten Erlebnisse</li>
											<li>Monatlich kündbar, ohne Verpflichtungen</li>
											<li>Entdecke Angebote von privaten Anbietern, die ausschließlich bei Kidwedo verfügbar sind </li>
										</ul>
									</div>
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="register-outer subscribe p-0 mb-20">
					<div class="row">
						
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<h5>ZAHLUNG</h5>
									<div class="subscribe-outer w-100 card-details">
										
										<!--<div class="row mb-20">
											<div class="col-lg-8  mb-20">
												<input type="password" class="custom-input" placeholder="Card number">
											</div>
											<div class="col-lg-4  mb-20">
												<input type="password" class="custom-input" placeholder="CVV">
											</div>
											<div class="col-lg-7">
												<input type="password" class="custom-input" placeholder="MM/YY">
											</div>
											<div class="col-lg-5">
												<input type="password" class="custom-input" placeholder="PIN">
											</div>
										</div> -->
										<p>Durch klicken auf den Button “Zahlen mit PayPal / Kreditkarte“ erklärst du dich mit 
											unseren Nutzungsbedingungen und der Datenschutzerklärung einverstanden.
											 Du kannst jederzeit kündigen.
                      					</p>
										<p class="bold-600">Kidwedo setzt deine Mitgliedschaft automatisch fort und belastet, nach der einmaligen Testversion von 10€,
											 deine Kreditkarte mit 40€ im Voraus, bis du kündigst. Es gibt keine Rückerstattung oder
											  Gutschrift für die Kündigung innerhalb eines laufenden Monats. 
										</p>
										<form method="POST" id="payment-form" action="{!! URL::to('paypal') !!}">
											@csrf
											<input class="w3-input w3-border" id="amount" type="hidden" name="amount" value="30">
											<input class="w3-input w3-border" id="currency" type="hidden" name="currency" value="EUR">
											<button class="kid-btn w-100">ZAHLEN MIT PAYPAL / KREDITKARTE</button>
										</form>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>			
				</div>
			</section>
			<!--subscribe-contents end-->
@endsection