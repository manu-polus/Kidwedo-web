@extends('layouts.partner')
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
							<div class="filter-checkbox-outer w-100">
								<ul>
										<li>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="distance-check1">
												<label class="custom-control-label" for="distance-check1">0-5 KM</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="distance-check2">
												<label class="custom-control-label" for="distance-check2">5-10 KM</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="distance-check2">
												<label class="custom-control-label" for="distance-check2">10-15 KM</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="distance-check2">
												<label class="custom-control-label" for="distance-check2">15-20 KM</label>
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
                <div class="col-lg-12">
            <div class="filter-btn-outer text-right w-100">
							<a href="{{ route('partneractivity') }}"><button type="button" class="filter-btn f-active-default w-auto">Angebot erstellen<!-- Add Activity --></button></a>
			</div>
            </div>
					<div class="col-lg-12 resulting-section"><!--listing-result-->
					</div>
				</div>
			</div>
			<!--calender-filter end-->
		</div>
	</div>
</div>
<!--activities end-->


<script>
function deleteActivity(btn){
    if(confirm("Are you sure you want to delete this?")){
			$(location).attr('href', btn.data('del'));
        return true;
    }
    else{
        return false;
    }
}

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

/*Events*/

$(document).ready(function(){
	getActivities();
});

$( "#slider-range" ).on( "slidechange", function( event, ui ) { getActivities(); } );

$(".age-check, .category-check, c-active").click(function(event){ 
	$(this).parents().eq(4).find(".clear_all").show();
	getActivities(); 
	});

$("#weeks").children("li").click(function(){ getActivities(); });

$(".clear_all").click(function(){
		$(this).parent().parent().find("li").each(function(){
		$(this).find(":checkbox").prop('checked', false);
	});
	$(this).hide();
	getActivities();
});
/*End Events*/
function getActivities()
{
    var age_selected = [];
    var category_selected = [];
    $('#age-group input:checked').each(function() { age_selected.push($(this).val()); });
    $('#category-group input:checked').each(function() { category_selected.push($(this).val()); });
    var from_time = $("#time_from").val();
    var to_time = $("#time_to").val();
    var request_ar = {};
    request_ar['from_time'] = from_time;
    request_ar['to_time'] = to_time;
    request_ar['age_group'] = (age_selected.length > 0) ? age_selected : "ALL";
    request_ar['category_selected'] = (category_selected.length > 0) ? category_selected : "ALL";
    request_ar['distance'] = "ALL";
    request_ar['paged'] = "1";
	request_ar['provider'] = "{{$dealer_id}}";
    console.log(JSON.stringify(request_ar));
	getActivitiesREST(JSON.stringify(request_ar));
}

function getActivitiesREST( json_data )
{
	$(".loader-back").show();
	$.ajax({
        url: "{{route('partner_activity_url')}}",
        type: "post",
        data: {query: json_data},
        success: function(d) {
            //console.log(d);
			$(".resulting-section").html(d);
        }
    });
}

function tConvert (time, time24) {
   var time_ar = parseInt(time.substr(0, time.indexOf(':'))); 
   return time;
   time += time_ar < 12 ? ' AM' : ' PM';
   if(time_ar > 12) time = time.replace(String(time_ar), String(time_ar-12));
	return time;
  }
</script>

@endsection