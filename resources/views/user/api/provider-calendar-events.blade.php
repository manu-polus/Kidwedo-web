@forelse($activities as $activity)
    @php
        $rating = 0;
        $count = 0;
    @endphp
    @if($rating_avg_list != null)
        @foreach($rating_avg_list as $rate)
            @php
                if($activity->event == $rate['event_id'])
                {
                    $rating = $rate['rating'];
                    $count = $rate['count'];
                    break;
                }
            @endphp
        @endforeach
    @endif
                    <div class="list-result-outer">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ Storage::url($activity->event_picture) }}" class="img-fluid">
                            </div>
                            <div class="col-lg-6 f-listing-description">
                                <h4><a href="{{ route('activity.view',['id' => $activity->event_id]) }}">{{ $activity->event_name }}</a></h4>
                                <div class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $rating > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div><span class="f-av">{{ $rating }} Average ({{ $count }})</span>
                                <div class="f-details w-100">
                                    <p>Ort: {{ $activity->city }}</p>
                                    <p>Alter: {{ $activity->age_description }}</p>
                                    <p>Kategorie: {{ $activity->category }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 flex">
                                <div class="f-icon-outer">
                                    <img src="{{ asset('images/tree-icon.png') }}" class="img-fluid" width="40px;">
                                </div>
                                <div class="credit-outer">
                                    <h6>{{ $activity->time }} Uhr</h6>
                                    <span>{{ $activity->event_duration }}</span>
                                    <p><img src="{{ asset('images/credit-icon.png') }}" width="10px">{{ $activity->credit }} Credits</p>
                                </div>
                            </div>
                            <div class="col-lg-1 p-0 v-h-center">
                                <button type="button" class="kid-btn small-btn">Buchen</button>
                            </div>
                        </div>
                    </div>
                    @empty
<div class="list-result-outer">
	<div class="row">
		<div class="col-lg-12 a-not-found text-center v-h-center">
			<div>
				<h3>LOOKS LIKE NO ACTIVITY FOUND FOR THIS PARTNER</h3>
				<p>Check out a different partner to join in on the fun!</p>
			</div>
		</div>
	</div>
</div>
@endforelse
<!--loader-->
<div class="loader-back">
	<div class="loader-img">
		<img src="{{asset('images/loader.gif')}}" class="img-fluid" width="100px">
	</div>
</div>
<!--loader-end-->