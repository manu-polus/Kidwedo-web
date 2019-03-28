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
				<h4>YOUR BOOKING IS SUCCESSFULL</h4>
			</div>
			<div class="col-lg-12 mb-15">
				<div class="ticket-outer">
					<span class="ticket-icon"><i class="fas fa-ticket-alt"></i></span>
					<div class="row p-15">
						<div class="col-lg-6 booking-label  bold-600">
							Booking ID
						</div>
						<div class="col-lg-6">
							{{$ticket_details->ticket_id}}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
							Booked Activity
						</div>
						<div class="col-lg-6">
                        {{$ticket_details->event_name}}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
							Booked Date & Time
						</div>
						<div class="col-lg-6">
                            {{$ticket_details->date}}, {{$ticket_details->from_time}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 text-center">
				<button type="button" class="kid-btn kid-small-btn" onclick='printDiv();'>Print Ticket</button>
			</div>
		</div>
	</div>
</section>
<script>

function printDiv() 
{
    $('#ticket-start').printThis({
    importCSS: true,
    loadCSS: "",
    header: "<h1>Kidwedo ticket</h1>"
});
}
</script>
@endsection