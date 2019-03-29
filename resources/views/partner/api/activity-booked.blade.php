@forelse($events as $event)
@php
	$image = Storage::url($event->pic_filename);
@endphp
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-3">
			<img src="{{ $event->pic_filename === '' ? asset('images/activities-1.jpg') : asset($image) }}" class="img-fluid">
		</div>
		<div class="col-lg-5 f-listing-description">
			<h4>{{$event->event_name}}</h4>
			<div class="f-details w-100">
                <p>User: {{$event->user_name}}</p>
			</div>
		</div>
		
		<div class="col-lg-3 flex">
			<div class="f-icon-outer">
				<img src="{{ asset('images/category/'.$event->icon_file_name) }}" class="img-fluid" width="40px;">
			</div>
			<div class="credit-outer">
				<span>{{$event->event_duration}}</span>
				<p><img src="{{ asset('images/credit-icon.png') }}" width="10px">{{$event->credit}} Credits</p>
			</div>
		</div>
		<div class="col-lg-1 p-0 v-h-center">
		@php
				$cancel_url = route('activity.cancel',['id' => $event->event_date_id ]);
			@endphp
			<button type="button" class="kid-btn small-btn" onclick="location.href='{{$cancel_url}}'">Stornieren</button>&nbsp;		</div>
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