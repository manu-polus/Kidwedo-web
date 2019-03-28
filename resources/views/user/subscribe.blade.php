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
									<h5>KIDWED EALEBEN</h5>
									<div class="subscribe-outer w-100">
										<h6>Erster Monat fur €10 testen</h6>
										<p>Die Testeversion beginnt zun zeitpunkt des kaufs und dauert eienen monat.</p>
										<p>Nach der Testphase verlangert sich ihre Mitgliedschaft automatisch um den Basisplan von 40€ pro monat.Sie konnen ihren
											Plan jederzeit andern oder stornieren
										</p>
										<div class="promocode w-100">
											<input type="password" class="custom-input" placeholder="Promocode">
											<button type="button" class="kid-btn input-equal-btn">Los GEHT's</button>
										</div>
									</div>
									<div class="subscribe-outer w-100 prices">
										<div class="row">
											<div class="col-10">
													<span>Monatliches Abonnement</span>
											</div>
											<div class="col-2 text-right">
													<span><b>40€</b></span>
											</div>
										</div>
									</div>
									<div class="subscribe-outer w-100 prices">
										<div class="row">
											<div class="col-10">
													<span>Rabatt</span>
											</div>
											<div class="col-2 text-right">
													<span><b>30€</b></span>
											</div>
										</div>
									</div>
									<div class="subscribe-outer w-100 prices active-price">
										<div class="row">
											<div class="col-10">
													<span>Erster Monat</span>
											</div>
											<div class="col-2 text-right">
													<span><b>30€</b></span>
											</div>
										</div>
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
										<h6>Vorteile der kidwedo-Mitgliedschaft</h6>
										<ul>
											<li>Buche Innerhalb von 5 Minuten Erlenisse bei hunderten von Anbietern</li>
											<li>Habe keine Verpflichtungen.Monatlich kundbar</li>
											<li>Entdecke Angebote die es sonst niergends gibt.</li>
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
										<p>Durch Klicken auf die Schaltfläche „Kauf abschließe, erklären Sie sich mit
											Unseren Nutzungsbedingungen und der datenschutzerklarung einverstanden.Sie 
											konnen jederzeit kundigen.
                      					</p>
										<p class="bold-600">Kidwedo setzt Ihre Mitgliedschaft automatisch monatlich fort und belastet 
					                      Ihre Kreditkarte monatlich mit dem Mitgliedsbeitrag mit 40€ im voraus, bis 
					                      Sie kündigen. Es gibt keine Rückerstattung oder Gutschrift für Teilmonate.
										</p>
										<form method="POST" id="payment-form" action="{!! URL::to('paypal') !!}">
											@csrf
											<input class="w3-input w3-border" id="amount" type="hidden" name="amount" value="30">
											<input class="w3-input w3-border" id="currency" type="hidden" name="currency" value="EUR">
											<button class="kid-btn w-100">PAY WITH PAYPAL / CREDIT CARD</button>
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