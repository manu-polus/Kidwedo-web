@extends('layouts.template')
@section('title')
Kidewedo ticket
@endsection
@section('content')
<section class="container-fluid register-bg" id='ticket-start'>
	<div class="container">
	<div class="activity-view  add-activity-outer booksuccess-outer  mb-20 w-70 m-auto">
		<div class="row p-15">
			<div class="col-lg-12 mb-15">
				<div class="ticket-outer">
					<span class="ticket-icon"><i class="fas fa-ticket-alt"></i></span>
					<div class="row p-15">
						<div class="col-lg-6 booking-label  bold-600">
						Buchungs-ID
						</div>
						<div class="col-lg-6">
							{{$ticket_details->ticket_id}}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
						Gebuchtes Angebot
						</div>
						<div class="col-lg-6">
                        {{$ticket_details->event_name}}
						</div>
						<div class="col-lg-6 booking-label  bold-600">
						Datum und Zeit der Buchung
						</div>
						<div class="col-lg-6">
                            {{$ticket_details->date}}, {{$ticket_details->from_time}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
.nav-outer, .footer{
	display: none;
}
</style>

<script>
$(document).ready(function(){
	$(".print-btn").css('display','none');
    $('#ticket-start').printThis({
    importCSS: true,
    loadCSS: "",
    header: "<h1 style='text-align:center;'>Kidwedo ticket</h1>"
	});
});
</script>
@endsection