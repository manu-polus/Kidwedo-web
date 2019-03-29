@extends('layouts.template')
@section('title')
Partner View
@endsection
@section('content')
<!--provider-view-contents-->
<section class="container-fluid register-bg">

<div class="container">

<div class="activity-view mb-20 w-100">
    <div class="row p-15">
        <div class="col-lg-2">
            <h5 class="m-0 h5-head">PROVIDER</h5>
        </div>
        <div class="col-lg-7 prov-act">
            <h5> {{ $dealer->business_name }} </h5>
            <span><div class='rated-stars'>
    									<ul id='star_id'>
      										<li class='stared {{ $provider_rating > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div></span>
            <small class="small-text">Alter: 6 Monate - 3 Jahre  </small>

            <small class="small-text mb-20">Kategorie: Spielen</small>
            <span class="pro-social">Tellen : <i class="fab fa-twitter-square"></i> <i class="fab fa-facebook-square"></i> <i class="far fa-envelope"></i></span>
        </div>
        <div class="col-lg-3">
            <img src="{{ $dealer_logo }}" class="img-fluid">
        </div>
    </div>
    <hr class="ac-seperation">
    <div class="row">
        <div class="col-lg-12 activity-view-ab">
            <div class="row">
                
                <div class="col-lg-6 f-listing-description">
                    <h4>UBER</h4>
                    <p>{{ $dealer->dealer_description }}</p>
                </div>
            
                <div class="col-lg-6 p-r w-100">
                    <img src="{{ $dealer_picture }}" class="img-fluid">
                    <div class="top-rated">
                        Top-Rated
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="ac-seperation">
    <div class="activity-view-d pb-0">
    <div class="row">
        <div class="col-lg-9">
            <h5 class="h5-head">KONTAKT</h5>
            @if($dealer->website != null)
            <span class="web-site">Website : <a href="http://{{ $dealer->website }}" target="_blank">{{ $dealer->website }}</a></span>
            @endif
            <span class="social-m mb-20">Social Media <i class="fab fa-facebook-square"></i></span>
            <button type="button" class="kid-btn kid-small-btn" data-toggle="modal" data-target="#messageModal">Nachricht senden</button>
            <div class="row">
            <div class="col-lg-12 review-cards">
                <h5>KUNDEN BEWERTUNGEN</h5>
                <div class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $provider_rating > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $provider_rating > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div><span class="rating-des">{{ $number_of_ratings }} Bewertungen</span>
            </div>
            @forelse($reviews as $rating)
            <div class="col-lg-12 review-cards">
                <div class="row">
                    <div class="col-lg-3">
                        <b>{{ $rating['name'] }}</b>
                    </div>
                    <div class="col-lg-9">
                        <span><div class='rated-stars d-inline-block'>
    									<ul id='star_id'>
      										<li class='stared {{ $rating["rating"] > 0 ? "selected" : "" }}' title='Poor' data-value='1'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating["rating"] > 1 ? "selected" : "" }}' title='Fair' data-value='2'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating["rating"] > 2 ? "selected" : "" }}' title='Good' data-value='3'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating["rating"] > 3 ? "selected" : "" }}' title='Excellent' data-value='4'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
      										<li class='stared {{ $rating["rating"] > 4 ? "selected" : "" }}' title='WOW!!!' data-value='5'>
        										<i class='fa fa-star fa-fw'></i>
      										</li>
    									</ul>
  									</div><b class="rating-des">{{ $rating['date'] }}</b></span>
                        <p>{{ $rating['comment'] }}</p>
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
        <div class="col-lg-3">
            <div class="time-date-box  w-100">
                <h5>NACHSTEN TERMINE</h5>
                <div class="time-date-01 w-100 text-center">
                    @foreach($next_five_activities as $activities)
                    <p>
                        @php
                            //Carbon\Carbon::setLocale('de');
                            $date = strtotime($activities->date);
                            //$date = $date->diffForHumans();
                            echo date('l, d.m',$date);
                        @endphp
                    </p>
                    <span>{{ $activities->from_time }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="all-reviews">
        <a href="">Alle Bewertungen</a>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-12">
        <div class="w-100 ac-providers">
            <div class="row">
                <!--calender-->
                <div class="col-lg-12">
                    
                    <div class=" calender-outer w-100">
                    <div class="row plr-15">
                        <div class="col-lg-1 control-item">
                            <span class="calender-prev"><i class="fas fa-chevron-left"></i></span>
                        </div>
                        <div class="col-lg-10">
                            <ul class="week-list" id="weeks">
                                <li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
								<li>
									<p></p>
									<span></span>
								</li>
                            </ul>
                        </div>
                        <div class="col-lg-1 control-item">
                            <span class="calender-next"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                </div>
                <h5 class="selected-day current-day"></h5>
                </div>
                <!--calender end-->
                <div class="col-lg-12 resulting-section" id="activity-calender-result"><!--listing-result-->
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="w-100 ac-providers">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2429.578646214085!2d13.353405715502115!3d52.48676437980787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a85040fb8711b9%3A0xd1f0ee404016d2a8!2sAkazienstra%C3%9Fe+3a%2C+10827+Berlin%2C+Germany!5e0!3m2!1sen!2sin!4v1552394757296" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>
</div>
</section>
<!--provider-view-contents end-->

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header kidwedo-modal-header">
			        <h5 class="modal-title" id="messageModalLabel">SEND MESSAGE</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
                  
			      <div class="modal-body">
				       <div class="row">
                       <form id="post_message" method="post" action="{{ route('message.post') }}" class="w-100">
                        @csrf
                            <div class="col-lg-12 mb-20">
                                <input type="hidden" name="to_user_id" value="{{ $dealer->user_id }}">
				       			<input type="text" class="custom-input" placeholder="Subject" name="subject" value="{{ old('subject') ? old('subject') : '' }}">
                                   @if ($errors->has('subject'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                            <script type="text/javascript">
                                                $( document ).ready(function() {
                                                    $('#messageModal').modal('show');
                                                });
                                            </script>
                                        @endif
				       		</div>
				       		<div class="col-lg-12">
				       			<textarea class="custom-textarea" placeholder="Nachricht schreiben" name="message">{{ old('message') ? old('message') : '' }}</textarea> 
                                   @if ($errors->has('message'))
                                            <span class="invalid" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            <script type="text/javascript">
                                                $( document ).ready(function() {
                                                    $('#messageModal').modal('show');
                                                });
                                            </script>
                                        @endif
				       		</div>
                        </form>
				       </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="kid-btn kid-small-btn kid-cancel-btn" data-dismiss="modal">Stornieren</button>
			        <button type="submit" form="post_message" class="kid-btn kid-small-btn">Send</button>
			      </div>
                </div>
			  </div>
			</div>
			<!-- Modal -->

            <!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header kidwedo-modal-header">
			        <h5 class="modal-title" id="ratingModalLabel">RATE US</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
                  
			      <div class="modal-body">
				       <div class="row">
                       <form id="post_rating" method="post" action="{{ route('provider_rating.post') }}" class="w-100">
                        @csrf
                            <div class="col-lg-12 mb-20">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="user_id_dealer" value="{{ $dealer->user_id }}">
                                <input type="hidden" name="dealer_id" value="{{ $dealer->dealer_id }}">
				       			<input type="text" class="custom-input" placeholder="Rate out of 5" name="rating" value="{{ old('rating') ? old('rating') : '' }}">
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
			        <button type="submit" form="post_rating" class="kid-btn kid-small-btn">Rate</button>
			      </div>
                </div>
			  </div>
			</div>
			<!-- Rating Modal -->

<script>

var current_date = new Date();
var init_date = new Date();
var init_date_year = init_date.getFullYear();
var init_date_month = init_date.getMonth()+1;
var init_date_day = init_date.getDate();

$(document).ready(function(){
    init_date.setDate(init_date.getDate() );
    makeCalender();
		getActivities();

});
$(".calender-prev").click(function(){
    init_date.setDate(init_date.getDate() - 14);
    if(init_date < current_date) init_date.setDate( current_date.getDate() );
    makeCalender();
});
$(".calender-next").click(function(){
    makeCalender();
});
$("#weeks").children("li").click(function(){
    var selected_date = new Date($(this).data("date"));
    var selected_date_formatted = selected_date.getDate() +"."+ (selected_date.getMonth()+1) +"."+ selected_date.getFullYear();
    $(".current-day").html( getDayNameFull(selected_date, "de-DE")+ ", " + selected_date_formatted );
    $("#weeks").children("li").removeClass("c-active");
    $(this).addClass("c-active");
});


/*Events*/

$("c-active").click(function(event){ getActivities(); });

$("#weeks").children("li").click(function(){ getActivities(); });

function getActivities()
{
		
    var date_element = $(".c-active").data("date-formatted");
    var user_id = "<?php echo $dealer->user_id; ?>";
    request_ar = {};
    request_ar['date'] = date_element;
    request_ar['user_id'] = user_id;
	//console.log(JSON.stringify(request_ar));
		getActivitiesREST( JSON.stringify(request_ar) );
		$(".calender-outer").css("display", "block");
}

function getActivitiesREST( calender_date )
		{
			$(".loader-back").show();
			$.ajax({
                url: provider_activity_cal_api_url,
                type: "post",
                data: {query: calender_date},
                success: function(d) {
                    //console.log(d);
										$("#activity-calender-result").html(d);
                }
            });
		}

function makeCalender()
{
    var selected_date_formatted = init_date.getDate() +"."+ (init_date.getMonth()+1) +"."+ init_date.getFullYear();
    $(".current-day").html( getDayNameFull(init_date, "de-DE")+ ", " + selected_date_formatted );
    $("#weeks").children("li").each(function(){
        var date_mysql_formated = init_date.getFullYear() +"-"+ (init_date.getMonth()+1) +"-"+ init_date.getDate();
        $(this).attr("data-date-formatted", date_mysql_formated);
        $(this).attr("data-date", init_date);
        $(this).find("p").html( getDayNameSmall(init_date, "de-DE"));
        $(this).find("span").html(init_date.getDate() +"."+ (init_date.getMonth()+1) );
        init_date.setDate(init_date.getDate() + 1);
        $("#weeks").children("li").removeClass("c-active");
        $('#weeks li:first-child').addClass('c-active');
    });
    init_date.setDate(init_date.getDate() - 1);
		$("#calender-outer").css("display", "block");
}

function getDayNameSmall(date, locale)
    {
        return date.toLocaleDateString(locale, { weekday: 'short' }).toUpperCase();        
    }
function getDayNameFull(date, locale)
    {
        return date.toLocaleDateString(locale, { weekday: 'long' });        
    }

</script>
@endsection