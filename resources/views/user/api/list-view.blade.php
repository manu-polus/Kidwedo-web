@foreach($activities as $activity)
@php
	$image = Storage::url($activity->pic_filename);
@endphp
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-3">
			<img src="{{ $activity->pic_filename === '' ? asset('images/activities-1.jpg') : asset($image) }}" class="img-fluid">
		</div>
		<div class="col-lg-4 f-listing-description">
			<h4>{{$activity->event_name}}</h4>
			<img src="{{ asset('images/rating.png') }}" class="img-fluid"><span class="f-av">Bewertungen 4</span>
			<div class="f-details w-100">
                <p>Ort: {{$activity->city}}</p>
				<p>Alter: {{$activity->age_description}}</p>
                <p>Anbieter: {{$activity->business_name}}</p>
			</div>
		</div>
        
		@php 
		$event_dt = json_decode($activity->event_datetime);
        @endphp
        @if(is_array($event_dt))
			@if(count($event_dt) > 0)
			<div class="col-lg-5 upcoming-sche">
				<h5>UPCOMING SCHEDULES</h5>
				@foreach($event_dt as $upcoming)
				@php
				$date_from = DateTime::createFromFormat('Y-m-d', $upcoming->date);
				@endphp
				<div class="row">
					<div class="col-lg-5 sche-days">
						<!--<span>TUE,3/12</span>-->
						<span>{{$date_from->format('D').", ". $date_from->format('d/m')}}</span>
					</div>
					<div class="col-lg-7 sche-time">
						<span><a href="{{ route('activity.view',['id' => $upcoming->event_date_id ]) }}">{{$upcoming->from_time}} - {{$upcoming->to_time}}</a></span>
					</div>
				</div>
				@endforeach
			</div>
			@endif
		@endif
	</div>
</div>
@endforeach