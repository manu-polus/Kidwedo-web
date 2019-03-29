@extends('layouts.template')
@section('title')
Booking success
@endsection
@section('content')
<section class="container-fluid register-bg" id='ticket-start'>
	<div class="container">
	<div class="activity-view  add-activity-outer booksuccess-outer  mb-20 w-70 m-auto">
		<div class="row p-15">
			<div class="col-lg-12 text-center">
				<i class="fas fa-check-circle verify-icon"></i>
				<h4>Ihre Zahlung war erfolgreich</h4>
			</div>
			<div class="col-lg-12 mb-15">
				<div class="ticket-outer">
					<span class="ticket-icon"><i class="fas fa-money"></i></span>
					<div class="row p-15">
						<div class="col-lg-6 booking-label bold-600">
							Transaktions-ID
						</div>
						<div class="col-lg-6 break-word">
							{{ $payment->transaction_id }}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
						Menge
						</div>
						<div class="col-lg-6">
                        {{ $payment->amount }} {{ $payment->currency }}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
						Vorteil
						</div>
						<div class="col-lg-6">
                            Added {{ $payment->credits }} more credits in your Account!
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection