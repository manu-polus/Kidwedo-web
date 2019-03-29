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