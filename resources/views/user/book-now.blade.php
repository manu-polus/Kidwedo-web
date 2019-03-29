@extends('layouts.template')
@section('title')
Buche Jetzt
@endsection
@section('content')

<!--activity-view-contents-->
<section class="container-fluid register-bg">
	<div class="container">
		<form action="{{route('activity.booking.post')}}" method="post">
			@csrf
			<div class="activity-view  add-activity-outer booknow-outer  mb-20 w-70 m-auto">
				<h5>JETZT BUCHEN</h5>
				<div class="sub-layer-outer">
					<div class="row p-15">
						<div class="col-lg-6">
							<label>Angebot</label>
						</div>
						<div class="col-lg-6">
							{{$event->event_name}}
						</div>
						<div class="col-lg-6">
							<label>Datum</label>
						</div>
						<div class="col-lg-6">
							{{$event_date->date}}
						</div>
						<div class="col-lg-6">
							<label>Zeit  </label>
						</div>
						<div class="col-lg-6">
							<select class="custom-select custom-select-box" name="time">
								@foreach($event_time as $event_time)
								<option value="{{$event_time->id}}">{{$event_time->from_time}}-{{$event_time->to_time}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-6">
							<label>Credits</label>
						</div>
						<div class="col-lg-6">
							<p class="mb-50">
								<img src="{{ asset('images/credit-icon.png') }}" width="20px"> {{$event->credit}} Credits
							</p>
						</div>
						<div class="col-lg-12 text-center mb-15">
							<div class="form-check">
							<input class="form-check-input" type="checkbox" value="accept" id="defaultCheck1" name="accept_check">
							<label class="form-check-label" for="defaultCheck1">
							Ich akzeptiere die allgemeinen Geschäftsbedingungen.
							</label>
		
							</div>
						</div>
						<div class="col-lg-12 text-center">
							<button type="submit" class="kid-btn kid-small-btn">JETZT BUCHEN</button>
							<button type="button" class="kid-btn kid-small-btn kid-cancel-btn">STONIEREN</button>
						</div>
						@if ($errors->any())
						<div class="col-lg-12 text-center">
							<span class="invalid" role="alert">
								{{ implode('', $errors->all(':message')) }}
							</span>
						</div>
						@endif
					</div>
				</div>
		</form>
	</div>
</section>
<!--activity-view-contents end-->

<script>
jQuery(document).ready(function() { 
    $( "#booking_date").datepicker({ 
        dateFormat: 'yy-mm-dd'
    });
});
</script>

@endsection
