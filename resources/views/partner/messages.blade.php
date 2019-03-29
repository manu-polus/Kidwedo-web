@extends('layouts.partner')
@section('title')
My Messages
@endsection
@section('content')
<!--message-view-contents-->
<section class="container-fluid register-bg">
	<div class="container">
		<div class="activity-view my-messages mb-20 w-100">
		<h5>MEINE NACHRICHTEN</h5>
		<div class="row p-15 msg-list">
						@foreach($messages as $message)
						@php
              $formdata=json_encode($message,JSON_HEX_APOS);
          @endphp
				<div class="col-lg-12  my-message-outer">
					<div class="flex w-100">
						<div class="user-msg-icon"><i class="fas fa-user-circle"></i></div>
						<div>
							<div>
								<b>{{ $message['subject'] }}</b>
							</div>
							<span>{{ $message['message'] }}</span>
							<p>{{ $message['time'] }} <b class="msg-from">{{ $message['name'] }}</b> |@if($message['from_user_id'] != Auth::user()->id)<span class="msg-reply"  data-toggle="modal" data-target="#messageModal" data-profile='<?php echo $formdata; ?>'>Antworten</span>|@endif<a href="{{ route('partner_message.delete',['id' => $message['id']]) }}" onclick="return delete_confirm()"><span class="msg-delete">Löschen</span></a></p>
						</div>
					</div>
					@if(isset($message['child']))
					@foreach($message['child'] as $child)
					@php
              $formdata=json_encode($child,JSON_HEX_APOS);
          @endphp
					<div class="col-lg-12"><!--loop-child-->
						<div class="flex w-100 pl-45">
								<div class="user-msg-icon msg-child-font-size"><i class="fas fa-user-circle"></i></div>
								<div>
									<span>{{ $child['message'] }}</span>
									<p>{{ $child['time'] }} <b class="msg-from">{{ $child['name'] }}</b> |@if($child['from_user_id'] != Auth::user()->id)<span class="msg-reply"  data-toggle="modal" data-target="#messageModal" data-profile='<?php echo $formdata; ?>'>Antworten</span>|@endif<a href="{{ route('partner_message.delete',['id' => $child['id']]) }}" onclick="return delete_confirm()"><span class="msg-delete">Löschen</span></a></p>
								</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
				@endforeach
				@if($messages == null)
				<div class="col-lg-12 a-not-found text-center v-h-center">
										<div>
											<h3>Du hast derzeit keine Nachrichten</h3>
										</div>
						</div>
				@endif
		</div>
	</div>
	</div>
</section>
<!--message-view-contents end-->
<!-- Button trigger modal -->


<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header kidwedo-modal-header">
			        <h5 class="modal-title" id="messageModalLabel">ANTWORTEN</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
				       <div class="row">
							 <form id="reply_message" method="post" action="{{ route('partner_message.post') }}" class="w-100">
                        @csrf
				       		<input type="hidden" id="to_user_id" name="to_user_id">
										<input type="hidden" id="subject" name="subject">
										<input type="hidden" name="parent_id" id="parent_id">
				       		<div class="col-lg-12">
				       			<textarea class="custom-textarea" placeholder="Nachricht schreiben" name="message"></textarea> 
										 @if ($errors->has('message'))
                         <span class="invalid" role="alert">
                             <strong>{{ $errors->first('message') }}</strong>
                         </span>
                     @endif
				       		</div>
								</form>
				       </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="kid-btn kid-small-btn kid-cancel-btn" data-dismiss="modal">Schließen</button>
			        <button type="submit" form="reply_message" class="kid-btn kid-small-btn">Senden</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Modal -->
<script src="{{ asset('js/kidwedo.js') }}"></script>
@if (count($errors) > 0)
        <script type="text/javascript">
        $( document ).ready(function() {
            $('#messageModal').modal('show');
        });
        </script>
      @endif    
			<script>
			$(".msg-reply").click(function(){
				 var editdata = $(this).data('profile');
				 $('#to_user_id').val(editdata.from_user_id);
				 $('#subject').val(editdata.subject);
				 if(editdata.parent_id == 0)
				 {
					 editdata.parent_id = editdata.id;
				 }
				 $('#parent_id').val(editdata.parent_id);
			});
			</script>
@endsection