@forelse($events as $event)
@php
	$image = Storage::url($event->pic_filename);
@endphp
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-3">
			<img src="{{ $event->pic_filename === '' ? asset('images/activities-1.jpg') : asset($image) }}" class="img-fluid">
		</div>
		<div class="col-lg-4 f-listing-description">
			<h4>{{$event->event_name}}</h4>
			<img src="{{ asset('images/rating.png') }}" class="img-fluid"><span class="f-av">Bewertungen 4</span>
			<div class="f-details w-100">
                <p>User: {{$event->user_name}}</p>
			</div>
		</div>
		
		<div class="col-lg-3 p-0 v-h-center">
			@php
				$cancel_url = route('activity.cancel',['id' => $event->event_date_id ]);
			@endphp
			<button type="button" class="kid-btn small-btn" onclick="location.href='{{$cancel_url}}'">Cancel</button>&nbsp;
		</div>
	</div>
</div>
@empty
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-12 a-not-found text-center v-h-center">
			<div>
				<h3>LOOKS LIKE THERE NO ACTIVITY FOUND</h3>
				<p>Check out a different day or update your filters to join in on the fun!</p>
			</div>
		</div>
	</div>
</div>
@if(count($events)>0)
@endforelse
<!--loader-->
<div class="loader-back">
	<div class="loader-img">
		<img src="{{asset('images/loader.gif')}}" class="img-fluid" width="100px">
	</div>
</div>
<!--loader-end-->
@endif