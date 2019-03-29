@extends('layouts.partner')
@section('title')
Activity View
@endsection
@section('content')
<!--activity-view-contents-->
<link rel="stylesheet" src="{{ asset('css/kidwedo.css') }}">
<section class="container-fluid register-bg">
				<div class="container">
				<div class="activity-view mb-20 w-100">
					<div class="row">
						<div class="col-lg-12 activity-view-ab">
							<div class="row">
								<div class="col-lg-4 p-r">
									<img src="{{ asset($activity_image) }}" class="img-fluid">
									<div class="top-rated">
										Top-Rated
									</div>
								</div>
								<div class="col-lg-5 f-listing-description">
									<h4>{{ $activity->event_name }}</h4>
									<h6>{{ $activity->business_name }}</h6>
									
									<div class="f-details w-100">
										<p>{{ $activity->city }}</p>
										<p>Ages: {{ $activity->age }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="ac-seperation">
					<div class="activity-view-d">
					<div class="row">
						<div class="col-lg-9">
							<p>{{ $activity->event_description }}</p>
							<div class="ac-details-01">
								<div class="row">
									<div class="col-lg-4">
										Warm ankommen:
									</div>
									<div class="col-lg-8">
										{{ $activity->arrive_before }}
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										Weitere Details: 
									</div>
									<div class="col-lg-8">
										  {{ $activity->additional_description }}
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										Stornierungsbedingungen:
									</div>
									<div class="col-lg-8">
										  {{ $activity->cancellation_policy }}
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										Begleitung erforderlich:
									</div>
									<div class="col-lg-8">
                                        {{ $activity->is_caregiver_needed == 'Y' ? 'ja' : 'nein' }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					<hr class="ac-seperation">
					<div class="activity-reviews w-100 pb-0">
						<div class="row">
							<div class="col-lg-12 review-cards">
								<h5>KUNDEN BEWERTUNGEN </h5>
								<span class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $rate_avg > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rate_avg > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rate_avg > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rate_avg > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rate_avg > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</span><span class="rating-des">{{ $rating_count }} Bewertungen</span>
							</div>
							@forelse($reviews as $rating)
                				@php $date = date('d.m.Y', strtotime($rating->created_at)); @endphp
							<div class="col-lg-12 review-cards">
								<div class="row">
									<div class="col-lg-3">
										<b>{{ $rating->name }}</b>
									</div>
									<div class="col-lg-9">
										<span><div class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $rating->rating > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating->rating > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating->rating > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating->rating > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating->rating > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div><b class="rating-des">{{ $date }}</b></span>
										<p>{{ $rating->comment }}</p>
									</div>
								</div>
							</div>
							@empty 
            				<div class="col-lg-12 a-not-found text-center v-h-center">
			    				<div>
				    				<h3>Currently no Reviews</h3>
								</div>
		    				</div>
            				@endforelse
						</div>
					</div>
					<div class="all-reviews">
						<a href="">Alle Bewertungen</a>
					</div>
				</div>
				
				</div>
			</section>
			<!--activity-view-contents end-->

			<!-- Rating Modal -->
			<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header kidwedo-modal-header">
			        <h5 class="modal-title" id="ratingModalLabel">RATE THIS ACTIVITY</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
                  
			      <div class="modal-body">
				       <div class="row">
                       <form id="post_rating" method="post" action="{{ route('activity_rating.post') }}" class="w-100">
                        @csrf
                            <div class="col-lg-12 mb-20">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
								<input type="hidden" name="event_id" value="{{ $activity->event }}">
								<input type="hidden" name="event_redirect" value="{{ $activity->event_id }}">
				       			<input type="hidden" class="custom-input" name="rating" id="rating">
                                  

								<div class='rating-stars text-center'>
    <ul id='stars'>
      <li class='star' title='Poor' data-value='1'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Fair' data-value='2'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Good' data-value='3'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Excellent' data-value='4'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='WOW!!!' data-value='5'>
        <i class='fa fa-star fa-fw'></i>
      </li>
    </ul>
  </div>
  
  <div class='success-box'>
    <div class='clearfix'></div>
    <img alt='tick image' width='32' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
    <div class='text-message'></div>
    <div class='clearfix'></div>
  </div>
  @if ($errors->has('rating'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('rating') }}</strong>
                                            </span>
                                            <script type="text/javascript">
                                                $( document ).ready(function() {
                                                    $('#ratingModal').modal('show');
                                                });
                                            </script>
                                        @endif



				       		</div>
				       		<div class="col-lg-12">
				       			<textarea class="custom-textarea" placeholder="Comment" name="comment">{{ old('comment') ? old('comment') : '' }}</textarea> 
                                   @if ($errors->has('comment'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                            <script type="text/javascript">
                                                $( document ).ready(function() {
                                                    $('#ratingModal').modal('show');
                                                });
                                            </script>
                                        @endif
				       		</div>
                        </form>
				       </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="kid-btn kid-small-btn kid-cancel-btn" data-dismiss="modal">Stornieren</button>
			        <button type="submit" form="post_rating" class="kid-btn kid-small-btn">Einreichen</button>
			      </div>
                </div>
			  </div>
			</div>
			<!-- Rating Modal -->
			<script src="{{ asset('js/kidwedo.js') }}"></script>
			
@endsection