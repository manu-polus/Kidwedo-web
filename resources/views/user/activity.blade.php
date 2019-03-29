@extends('layouts.template')
@section('title')
Activities
@endsection
@section('content')

<!--activities start-->
<div class="container-fluid mb-20 mt-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 filter">
				<div class="sliding-filter w-100 mb-20">
					<!-- Slider -->
					<h6>ZEIT</h6>
					<!--<p>Price Range:<p id="amount"></p></p>-->
					<div class="time-binding w-100">
						<small class="start-t">5:00</small>
						<small class="end-t float-right">23:00</small>
					</div>
				  <div id="slider-range" class="range-outer"></div>
				    <input type="hidden" id="time_from" value="5:00">
				    <input type="hidden" id="time_to" value="23:00">
				</div>
				<div class="filter-dropdowns w-100">
					<ul class="filter-list">
						<li class="drop-item">
							<div class="dropdown-click">
								<span>ALTER</span>
								<span class="clear_all">Alles löschen</span>
								<span class="filter-icon"><i class="fas fa-chevron-down"></i></span>
							</div>
							<div class="filter-checkbox-outer w-100" id="age-group">
								<ul>
                                @foreach($age_groups as $index=>$age_group)
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input age-check" id="older-check{{$index}}" name="ages[]" value="{{$age_group->id}}">
										  <label class="custom-control-label" for="older-check{{$index}}">{{$age_group->description}}</label>
										</div>
									</li>
                                @endforeach
								</ul>
							</div>
						</li>
						<li class="drop-item">
							<div class="dropdown-click">
								<span>KATEGORIE</span>
								<span class="clear_all">Alles löschen</span>
								<span class="filter-icon"><i class="fas fa-chevron-down"></i></span>
							</div>
							<div class="filter-checkbox-outer w-100" id="category-group">
								<ul>
                                @foreach($categories as $index=>$category)
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input category-check" id="cat-check{{$index}}" name="category[]" value="{{$category->id}}">
										  <label class="custom-control-label" for="cat-check{{$index}}">{{$category->description}}</label>
										</div>
									</li>
                                @endforeach
								</ul>
							</div>
						</li>
						<li class="drop-item">
							<div class="dropdown-click">
								<span>ENTVERNUNG</span>
								<span class="clear_all">Alles löschen</span>
								<span class="filter-icon"><i class="fas fa-chevron-down"></i></span>
							</div>
							<div class="filter-checkbox-outer w-100 " id="distance_check">
								<ul>
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input distance-filter" id="distance-check1" value="1">
										  <label class="custom-control-label" for="distance-check1">0-5 KM</label>
										</div>
									</li>
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input distance-filter" id="distance-check2" value="2">
										  <label class="custom-control-label" for="distance-check2">5-10 KM</label>
										</div>
									</li>
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input distance-filter" id="distance-check3" value="3">
										  <label class="custom-control-label" for="distance-check3">10-15 KM</label>
										</div>
									</li>
									<li>
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input distance-filter" id="distance-check4" value="4">
										  <label class="custom-control-label" for="distance-check4">15-20 KM</label>
										</div>
									</li>
									
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div><!--check-box-filter-end-->
			<!--calender-filter start-->
			<div class="col-lg-9 calender-filter">
				<div class="row">
					<!--calender-->
					<div class="col-lg-12">
						<div class="filter-btn-outer text-right w-100">
							<button type="button" class="filter-btn f-active" id="calender-view">KALENDER</button>
							<button type="button" class="filter-btn" id="list-view">LISTE</button>
						</div>
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
					<h5 class="selected-day popular-day" style="display:none;">Beliebteste Angebote</h5>
					</div>
					<!--calender end-->
					<div class="col-lg-12 resulting-section" id="activity-calender-result"><!--listing-result-->
					
					</div>
					<!--loader-->
					<div class="loader-back">
						<div class="loader-img">
							<img src="{{asset('images/loader.gif')}}" class="img-fluid" width="100px">
						</div>
					</div>
					<!--loader-end-->
				</div>
			</div>
			<!--calender-filter end-->
		</div>
	</div>
</div>
<!--activities end-->

<script>
$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		
$( "#slider-range" ).slider({
  range: true,
  min: 5,
  max: 23,
  values: [ 5, 23 ],
  step: 0.5,
  slide: function( event, ui ) {
    var from = String(ui.values[ 0 ]);
    var to = String(ui.values[ 1 ]);
    if(from.match(/.5/gi) != null && from != "15"){
    	from = from.replace(".5", ":30");
    	//console.log(from.match(/.5/gi));
    }
    else{
    	from += ":00";
    }
    if(to.match(/.5/gi) != null && to != "15"){
    	to = to.replace(".5", ":30");
    }
    else{
    	to += ":00";
    }
    from = tConvert(from, true);
    to = tConvert(to, true);
    		$( "#time_from" ).val(from);
    		$( "#time_to" ).val(to);
    		$('.start-t').html(tConvert(from, false)); 
         	$('.end-t').html( tConvert(to, false));
          }
});

var current_date = new Date();
var init_date = new Date();
var init_date_year = init_date.getFullYear();
var init_date_month = init_date.getMonth()+1;
var init_date_day = init_date.getDate();
var paged = 0;
var empty = false;

$(document).ready(function(){
    init_date.setDate(init_date.getDate() );
    makeCalender();
		getActivities();
});

$(".calender-prev").click(function(){
    init_date.setDate(init_date.getDate() - 14);
		if(init_date < current_date) init_date.setDate( current_date.getDate() );
		$("#activity-calender-result").html("");
    makeCalender();
});

$(".calender-next").click(function(){
		$("#activity-calender-result").html("");
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

$( "#slider-range" ).on( "slidechange", function( event, ui ) { 
	paged = 0;
	empty = false;
	$("#activity-calender-result").html(""); 
	getActivities(); } );

$(".age-check, .category-check, c-active, .distance-filter").click(function(event){
	paged = 0;
	empty = false;
	$("#activity-calender-result").html("");
	$(this).parents().eq(4).find(".clear_all").show();
	getActivities(); 
});

$("#weeks").children("li").click(function(){
	paged = 0;
	empty = false;
	$("#activity-calender-result").html("");
	getActivities(); });

$("#calender-view").click(function(){ 
	$("#activity-calender-result").html("");
	$(this).addClass("f-active"); 
	$("#list-view").removeClass("f-active");
	getActivities(); 
 });

$("#list-view").click(function(){ 
	paged = 0;
	empty = false;
	$("#activity-calender-result").html("");
	$(this).addClass("f-active"); 
	$("#calender-view").removeClass("f-active");
	getActivities(); 
	});

	$(".clear_all").click(function(){
		paged = 0;
		empty = false;
		$(this).parent().parent().find("li").each(function(){
		$(this).find(":checkbox").prop('checked', false);
	});
	$(this).hide();
	getActivities();
});

/*End Events*/
function getActivities()
{
		var age_selected = "";
		var category_selected = "";
		var distance_selected = "";
		var listOrCal = calenderOrList();
    $('#age-group input:checked').each(function() { age_selected += $(this).val() + ','; });
		$('#category-group input:checked').each(function() { category_selected += $(this).val() +','; });
		$('#distance_check input:checked').each(function() { distance_selected += $(this).val() +','; });
		age_selected = age_selected.replace(/,\s*$/, "");
		category_selected = category_selected.replace(/,\s*$/, "");
		distance_selected = distance_selected.replace(/,\s*$/, "");
    var from_time = $("#time_from").val();
    var to_time = $("#time_to").val();

    var date_element = $(".c-active").data("date-formatted");
		//console.log("dateElem", $(".c-active"));
    var request_ar = {};
    request_ar['date'] = listOrCal == "calender" ? date_element : "ALL";
		//request_ar['date'] = listOrCal == "calender" ? '2019-03-13' : "ALL";
    request_ar['from_time'] = from_time;
    request_ar['to_time'] = to_time;
    request_ar['age_group'] = (age_selected.length > 0) ? age_selected : "ALL";
		request_ar['categories'] = (category_selected.length > 0) ? category_selected : "ALL";
		request_ar['distance'] = (distance_selected.length > 0) ? distance_selected : "ALL";
		request_ar['latitude'] = "8.5606831";
		request_ar['longitude'] = "76.8603516";
    request_ar['paged'] = paged.toString();
		request_ar['type'] = listOrCal == "calender" ? "1" : "2";
    console.log(JSON.stringify(request_ar));
		getActivitiesREST( JSON.stringify(request_ar) );
		$(".calender-outer").css("display", "block");
		showOrHideCalender(listOrCal);
}

function getActivitiesREST( json_data )
		{
			$(".loader-back").show();
			$.ajax({
                url: activity_cal_api_url,
                type: "post",
                data: {query: json_data},
                success: function(d) {
										if(d=="") {
											empty = true;
											$("#activity-calender-result").append('<div class="list-result-outer"><div class="row"><div class="col-lg-12 a-not-found text-center v-h-center"><div><h3>Es wurde keine Aktivität gefunden</h3><p>Sieh dir einen anderen Tag an, oder aktualisiere die Filter, um mehr zu erleben!</p></div></div></div></div>');
										}
										else{
											$("#activity-calender-result").append(d);
										}
										$(".loader-back").hide();
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
		//console.log(init_date);
}

function tConvert (time, time24) {
   var time_ar = parseInt(time.substr(0, time.indexOf(':'))); 
   return time;
	 //console.log(time);
   time += time_ar < 12 ? ' AM' : ' PM';
   if(time_ar > 12) time = time.replace(String(time_ar), String(time_ar-12));
	return time;
  }

function getDayNameSmall(date, locale)
    {
        return date.toLocaleDateString(locale, { weekday: 'short' }).toUpperCase();        
    }
function getDayNameFull(date, locale)
    {
        return date.toLocaleDateString(locale, { weekday: 'long' });        
    }
function calenderOrList()
{
	if($("#calender-view").hasClass("f-active")) return 'calender';
	if($("#list-view").hasClass("f-active")) return 'list';
}
function showOrHideCalender(listOrCal)
{
	if(listOrCal == "list"){
		$(".calender-outer").css("display", "none");
		$(".popular-day").show();
		$(".current-day").hide();
	}
	else{
		$(".popular-day").hide();
		$(".current-day").show();
	}

}

$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
			if(!empty){
				paged++;
				getActivities();
			}
    }
});
</script>

@endsection