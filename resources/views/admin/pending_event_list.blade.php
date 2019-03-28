@extends('layouts.admin')

@section('content')
@php $count = 1; @endphp
<div class="box-header">
    <h3 class="box-title">Pending Events</h3>
</div>

<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Event Name</th>
                  <th>Partner</th>
                  <th>Options</th>
                  <th></th>
                </tr>
                </thead>
                @forelse($pending_events as $pending_event)
                @php
                    $formdata=json_encode($pending_event,JSON_HEX_APOS);
                @endphp
                <tr>
                  <td>{{ $count++ }}</td>
                  <td>{{ $pending_event->event_name }}</td>
                  <td>{{ $pending_event->business_name }}</td>
                  <td>
                        <i class="fa fa-eye modal-view" style="color: blue; cursor: pointer;" data-toggle="modal" data-target="#modal-info" title="View this Event" data-profile='<?php echo $formdata; ?>'></i>
                        <a href="{{ route('approve_event',['id' => $pending_event->event_id ]) }}"><i class="fa fa-thumbs-o-up" style="color: green" title="Approve this Event"></i></a>
                  </td>
                </tr>
                @empty
                <tr class="text-center">
			        <td>
				        <td colspan="3">LOOKS LIKE NO PENDING EVENTS FOUND</td>
				    </td>
		        </tr>
                @endforelse
              </table>
</div>

<div class="modal modal-info fade" id="modal-info">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <strong>Event Name :</strong> <span class="vieweventname"></span><br>
                                    <strong>Partner :</strong> <span class="viewpartner"></span><br>
                                    <strong>Credits required :</strong> <span class="viewcredits"></span><br>
                                    <strong>Duration :</strong> <span class="viewduration"></span><br>
                                    <strong>Place :</strong> <span class="viewplace"></span><br>
                                    <strong>Care giver needed ? :</strong> <span class="viewcaregiverrequired"></span><br>
                                    <strong>Cancellation policy :</strong> <span class="viewcancelpolicy"></span><br>
                                    <strong>Event created at :</strong> <span class="viewcreatedat"></span><br>
                                    <strong>Event updated at :</strong> <span class="viewupdatedat"></span><br><br>
                                    <strong>About event</strong><div class="viewaboutevent"></div>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <!-- /.box-body -->
            <script>
                $(".modal-view").click(function(){
                    var viewdata = $(this).data('profile');
                    var care = '';
                    if(viewdata.is_caregiver_needed == 'Y')
                    {
                        care = 'Yes';
                    }
                    else
                    {
                        care = 'No';
                    }
                    $('.modal-title').html(viewdata.event_name);
                    $('.vieweventname').html(viewdata.event_name);
                    $('.viewpartner').html(viewdata.business_name);
                    $('.viewcredits').html(viewdata.credit);
                    $('.viewduration').html(viewdata.event_duration);
                    $('.viewplace').html(viewdata.city);
                    $('.viewcaregiverrequired').html(care);
                    $('.viewcancelpolicy').html(viewdata.cancellation_policy);
                    $('.viewcreatedat').html(viewdata.event_created_date);
                    $('.viewupdatedat').html(viewdata.event_updated_date);
                    $('.viewaboutevent').html(viewdata.description);
                });
            </script>
@endsection