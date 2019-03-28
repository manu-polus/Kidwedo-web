@foreach($activities as $activity)
@php
	$image = Storage::url($activity->pic_filename);
@endphp
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-3">
			<img src="{{ $activity->pic_filename === '' ? asset('images/activities-1.jpg') : asset($image) }}" class="img-fluid">
		</div>
		<div class="col-lg-5 f-listing-description">
			<h4><a href="{{ route('activity.view',['id' => $activity->event_date_id ]) }}">{{$activity->event_name}}</a></h4>
			<img src="{{ asset('images/rating.png') }}" class="img-fluid"><span class="f-av">Bewertungen 4</span>
			<div class="f-details w-100">
                <p>Ort: {{$activity->city}}</p>
				<p>Alter: {{$activity->age_description}}</p>
                <p>Anbieter: {{$activity->business_name}}</p>
			</div>
		</div>
		<div class="col-lg-3 flex">
			<div class="f-icon-outer">
				<img src="{{ asset('images/category/'.$activity->icon_file_name) }}" class="img-fluid" width="40px;">
			</div>
			<div class="credit-outer">
				<h6>{{$activity->from_time}}</h6>
				<span>{{$activity->event_duration}}</span>
				<p><img src="{{ asset('images/credit-icon.png') }}" width="10px">{{$activity->credit}} Credits</p>
			</div>
		</div>
		<div class="col-lg-1 p-0 v-h-center">
			<button type="button" class="kid-btn small-btn" onclick="location.href='{{ route('activity.view',['id' => $activity->event_date_id]) }}'">Buchen</button>
		</div>
	</div>
</div>

@endforeach