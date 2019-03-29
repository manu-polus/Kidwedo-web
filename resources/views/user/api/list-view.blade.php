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
			<div class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $activity->event_rating > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $activity->event_rating > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $activity->event_rating > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $activity->event_rating > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $activity->event_rating > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div><span class="f-av">Bewertungen {{ $activity->event_rating }}</span>
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