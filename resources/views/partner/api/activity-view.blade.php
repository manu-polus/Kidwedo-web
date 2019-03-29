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
                <p>Ort: {{$event->city}}</p>
				<p>Alter: {{$event->age}}</p>
                <p>Anbieter: {{$event->business_name}}</p>
			</div>
		</div>
		<div class="col-lg-2 flex">
			<div class="f-icon-outer">
				<img src="{{ asset('images/category/'.$event->icon) }}" class="img-fluid" width="40px;">
			</div>
			<div class="credit-outer">
				<p><img src="{{ asset('images/credit-icon.png') }}" width="10px">{{$event->credit}} Credits</p>
			</div>
		</div>
		<div class="col-lg-3 p-0 v-h-center">
			@php
				$edit_url = route('activity.edit',['id' => $event->id ]);
				$delete_url = route('activity.delete',['id' => $event->id ]);
			@endphp
			<button type="button" class="kid-btn small-btn bg-color-2 bd-color-2" onclick="location.href='{{$edit_url}}'">bearbeiten</button>&nbsp;
			<button type="button" class="kid-btn small-btn delete-button" data-del="{{$delete_url}}" onclick="deleteActivity($(this))">löschen</button>
		</div>
	</div>
</div>
@empty
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-12 a-not-found text-center v-h-center">
			<div>
				<h3>Es wurde keine Aktivität gefunden</h3>
				<p>Sieh dir einen anderen Tag an, oder aktualisiere die Filter, um mehr zu erleben!</p>
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