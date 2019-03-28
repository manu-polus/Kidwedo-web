@extends('layouts.partner')

@section('title')
Edit Activity
@endsection
@section('content')
<!--register-contents-->
<script src="{{ asset('js/wickedpicker.min.js') }}"></script>

<section class="container-fluid register-bg">
	<div class="container">
		<div class="activity-view  add-activity-outer mb-20 w-70 m-auto">
			<h5>ANGEBOT ERSTELLEN</h5>
			<form method="POST" action="{{ route('activity.update',['id' => $activity->id]) }}" enctype="multipart/form-data" id="edit-event-form">
								@csrf
			<div class="row p-15">
				<div class="col-lg-6">
					<div class="form-group">
						<label class="bold-600">Bezeichung</label>
						<input type="text" class="custom-input" placeholder="Bezeichung" name="event_name" value="{{ old('event_name') ? old('event_name') : $activity->event_name  }}">
						@if ($errors->has('event_name'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('event_name') }}</strong>
									</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label  class="d-b bold-600">BILD/PHOTO</label>
						<input type="file" placeholder="Activity image" name="event_pic" id="event_pic" value="{{ old('event_pic') ? old('event_pic') : $activity->pic_filename }}" style="display:none;">
						<img id="img_display" src="{{asset($activity_image)}}" alt="your image" style="width: 50px; height: auto" />
						<button type="button" id="add_img_btn" class="kid-btn kid-small-btn w-100">Bild hochladen</button>
						<button type="button" id="delete_img_btn" class="kid-btn kid-small-btn w-100">Lösche Bild</button>
						@if ($errors->has('event_pic'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('event_pic') }}</strong>
									</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="d-b bold-600">Begleitung Erforderlich</label>
						<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="caregiver" id="caregiver1" value="Y" {{ old('caregiver') ? (old('caregiver') == 'Y' ? 'checked' : '' ) : ($activity->is_caregiver_needed == 'Y' ? 'checked' : '') }}>
						<label class="form-check-label" for="inlineRadio1">Jaa</label>
						</div>
						<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="caregiver" id="caregiver2" value="N" {{ old('caregiver') ? (old('caregiver') == 'N' ? 'checked' : '' ) : ($activity->is_caregiver_needed == 'N' ? 'checked' : '') }}>
						<label class="form-check-label" for="inlineRadio2">Nein</label>
						</div>
						@if ($errors->has('caregiver'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('caregiver') }}</strong>
									</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label  class="d-b bold-600">Altersgrupe</label>
						<select class="custom-select custom-select-box" name="age">
							<option selected disabled>Age Group</option>
							@foreach($ages as $age)
								<option {{ old('age') ? (old('age') == $age->id ? 'selected' : '' ) : ($age->id == $activity->preferred_age_id ? 'selected' : '') }} value = "{{ $age->id }}">{{ $age->description }}</option>
							@endforeach
						</select>
						@if ($errors->has('age'))
										<span class="invalid" role="alert">
											<strong>{{ $errors->first('age') }}</strong>
										</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="bold-600">Beschreibung</label>
						<textarea class="custom-textarea"  placeholder="Beschreibung" name="description">{{ old('description') ? old('description') : $activity->description }}</textarea>
						@if ($errors->has('description'))
										<span class="invalid" role="alert">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="bold-600">zusätzliche Details</label>
						<textarea class="custom-textarea"  placeholder="zusätzliche Details" name="additional_description">{{ old('additional_description') ? old('additional_description') : $activity->additional_description  }}</textarea>
						@if ($errors->has('additional_description'))
										<span class="invalid" role="alert">
											<strong>{{ $errors->first('additional_description') }}</strong>
										</span>
									@endif
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="form-group">
						<label  class="d-b bold-600">Kategorie</label>
						<select class="custom-select custom-select-box" name="category">
							<option selected disabled>Kategorie</option>
							@foreach($categories as $category)
											<option {{ old('category') ? (old('category') == $category->id ? 'selected' : '' ) : ($category->id == $activity->category_id ? 'selected' : '') }} value = "{{ $category->id }}">{{ $category->description }}</option>
							@endforeach
						</select>
						@if ($errors->has('category'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('category') }}</strong>
									</span>
									@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="bold-600">Kosten</label>
						<input type="text" class="custom-input" placeholder="Kosten" name="credits" value="{{ old('credits') ? old('credits') : $activity->credits_in_euro }}">
						@if ($errors->has('credits'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('credits') }}</strong>
									</span>
									@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label  class="bold-600">Ankommen</label>
						<input type="text" class="custom-input" placeholder="Ankommen" name="arrive_before" value="{{ old('arrive_before') ? old('arrive_before') : $activity->arrive_before }}">
						@if ($errors->has('arrive_before'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('arrive_before') }}</strong>
									</span>
									@endif
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="form-group">
						<div class="form-group">
						<label  class="bold-600">Stornierungsbedingungen</label>
						<input type="text" class="custom-input" placeholder="Stornierungsbedingungen" name="cancel_policy" value="{{ old('cancel_policy') ? old('cancel_policy') : $activity->cancellation_policy }}">
						@if ($errors->has('cancel_policy'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('cancel_policy') }}</strong>
									</span>
									@endif
					</div>
					</div>
				</div>
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="bold-600">Datum/Zeit</label>
							<div class="datepicker-outer">
								<div id="event-dates"></div>
							</div>
						</div>
						<input type="hidden" id="date_list_input" name="date_list_input">
						<div class="date_error"></div>
					</div>
					
					<div class="col-lg-6">
						<div class="form-group">
							<label class="bold-600">Datum/Zeit</label>
							<div class="nowwrap date-time-sloat">
								<div class="input-icon-outer">
									<input type="text" class="custom-input timepicker" placeholder="Time" name="timepicker1" id="from_time">
									<i class="far fa-clock"></i>
								</div>
								<div class="vh-center">TO</div>
								<div class="input-icon-outer">
									<input type="text" class="custom-input timepicker" placeholder="Time" name="timepicker2" id="to_time">
									<i class="far fa-clock"></i>
								</div> 
								<div class="add-icon-outer v-center">
									<span id="add_time"><i class="fas fa-plus-circle"></i>Add Time</span>
								</div>
							</div>
						</div>
						<div id="time_list" class="add-time-list">
							@foreach($times as $time)
								<p>{{$time->from_time}} - {{$time->to_time}}<i class="fas fa-times" onclick="removeDate($(this))" data-index="{{$loop->index}}"></i></p>
							@endforeach
						</div>
						<input type="hidden" id="time_list_input" name="time_list_input">
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="bold-600">Standort hinzufügen</label>
							<div class="input-icon-outer">
								<input type="text" class="custom-input" placeholder="Standort hinzufügen" name="place" value="{{ old('place') ? old('place') : $activity->city }}">
								@if ($errors->has('place'))
									<span class="invalid" role="alert">
										<strong>{{ $errors->first('place') }}</strong>
									</span>
									@endif
								<i class="fas fa-map-marker-alt"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-12 mb-20">
						<div class="w-100 ac-providers">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2429.578646214085!2d13.353405715502115!3d52.48676437980787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a85040fb8711b9%3A0xd1f0ee404016d2a8!2sAkazienstra%C3%9Fe+3a%2C+10827+Berlin%2C+Germany!5e0!3m2!1sen!2sin!4v1552394757296" style="border:0" allowfullscreen="" width="100%" height="450" frameborder="0"></iframe>
						</div>
					</div>
					<div class="col-lg-12 text-center">
						<button type="submit" class="kid-btn kid-small-btn" id="edit-activity-submit">Angebot Erstellen</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</section>
			<style>
/* jQuery UI Datepicker moving pixels fix */
table.ui-datepicker-calendar {border-collapse: separate;}
.ui-datepicker-calendar td {border: 1px solid transparent;}

/* jQuery UI Datepicker hide datepicker helper */
#ui-datepicker-div {display:none;}

/* jQuery UI Datepicker emphasis on selected dates */
.ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
	background: #743620 none;
	color: white;
}
</style>
<script src="{{ asset('js/wickedpicker.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.multidatespicker.js') }}"></script>

<script>
	@if($activity_image == "")
		$('#img_display').hide();
		$('#delete_img_btn').hide();
	@else
		$('#add_img_btn').hide();
	@endif
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
					$('#img_display').show();
            $('#img_display').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#event_pic").change(function(){
    if ($('#event_pic').get(0).files.length != 0) 
    {
        $("#add_img_btn").hide();
        $('#delete_img_btn').show();
    }
    readURL(this);
});

$("#add_img_btn").click(function(e){
    e.preventDefault();
    $("#event_pic").trigger("click");
});
$("#delete_img_btn").click(function(e){
    e.preventDefault();
    $('#img_display').hide();
    $("#event_pic").val("");
    $('#delete_img_btn').hide();
    $("#add_img_btn").show();
});

var options = { now: "12:35", //hh:mm 24 hour format only, defaults to current time 
    twentyFour: true, //Display 24 hour format, defaults to false 
    upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS 
    downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS 
    close: 'wickedpicker__close', //The close class selector to use, for custom CSS 
    hoverState: 'hover-state', //The hover state class to use, for custom CSS 
    title: 'Timepicker', //The Wickedpicker's title, 
    showSeconds: false, //Whether or not to show seconds, 
    secondsInterval: 1, //Change interval for seconds, defaults to 1  , 
    minutesInterval: 1, //Change interval for minutes, defaults to 1 
    beforeShow: null, //A function to be called before the Wickedpicker is shown 
    show: null, //A function to be called when the Wickedpicker is shown 
    clearable: false, //Make the picker's input clearable (has clickable "x") 
};

var dates = new Array();
var index = -1;
var timepicker = $('.timepicker').wickedpicker(options);
var y='2019';

$(document).ready(function(){
	$( "#event-dates" ).multiDatesPicker({
		minDate: 0,
		dateFormat: "yy-mm-dd",
		@if(count($dates) > 0)
		addDates: [
			@foreach($dates as $date)
				"{{$date->date}}",
			@endforeach
		]
		@endif
	});
	@foreach($times as $time)
		dates[++index] = {from: '{{$time->from_time}}', to: '{{$time->to_time}}'};
	@endforeach
	$("#time_list_input").val('{{$date_comma}}');

});

$("#add_time").click(function(){ 

	var selected = $('#from_time').val().replace(/ /g, "") +" - "+ $('#to_time').val().replace(/ /g, "");
	dates[++index] = {from: $('#from_time').val(), to: $('#to_time').val()};
   $("#time_list").append('<p>'+selected+' <i class="fas fa-times" onclick="removeDate($(this))" data-index="'+index+'"></i></p>');
});

$("#edit-activity-submit").on("click", function(event){
	event.preventDefault();
	$(".date_error").html('');
	if($("#event-dates").val() == ""){
		$(".date_error").html('<span class="invalid" role="alert"><strong>Please select date!</strong></span>');
		return false;
	}
	if(dates.length == 0){
		$("#time_list").html('<span class="invalid" role="alert"><strong>Please select atleast one timeslot!</strong></span>');
		return false;
	}
	$("#date_list_input").val($("#event-dates").val());
	$("#time_list_input").val(JSON.stringify(dates));
	$("#edit-event-form").submit();
});

function removeDate(item){
	dates.splice(item.data('index'), 1);
	item.parent().remove();
}

</script>

<!--register-contents end-->
@endsection