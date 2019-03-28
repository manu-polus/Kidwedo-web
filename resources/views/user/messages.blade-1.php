@extends('layouts.template')
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
					@forelse($messages as $message)
					@php
              $formdata=json_encode($message,JSON_HEX_APOS);
          @endphp
						<div class="col-lg-12 flex my-message-outer">
							<div class="user-msg-icon"><i class="fas fa-user-circle"></i></div>
							<div>
								<div>
									@if($message->parent_id == 0 )
									<b>{{ $message->subject }}</b>
									@endif
								</div>
								<span>{{ $message->message }}</span>
								<p>
								@php 
								$interval = $message->created_at->diff($current_date);
								if($interval->y > 0)
								{
									echo $interval->y." Year(s) ago by";
								}
								elseif($interval->m > 0)
								{
									echo $interval->m." Month(s) ago by";
								}
								elseif($interval->d > 0)
								{
									echo $interval->d." Day(s) ago by";
								}
								elseif($interval->h > 0)
								{
									echo $interval->h." Hour(s) ago by";
								}
								else
								{
									echo $interval->i." Minute(s) ago by";
								}
								@endphp
								<b class="msg-from">
								@php
									$test = DB::table('users')->select('name')->where('id','=',$message->from_user_id)->first();
									echo $test->name;
								@endphp
								</b> |@if($message->from_user_id != Auth::user()->id)<span class="msg-reply"  data-toggle="modal" data-target="#messageModal" data-profile='<?php echo $formdata; ?>'>Antworten</span>|@endif<span class="msg-delete">Löschen</span></p>
							</div>
							@php
								$childs = DB::table('messages')->where('parent_id','=',$message->id)->get();
							@endphp
							@foreach($childs as $child)
							@php
                    $formdata=json_encode($child,JSON_HEX_APOS);
          		@endphp
							<div>
							<div class="user-msg-icon"><i class="fas fa-user-circle"></i></div>
							<div>
								<div>
									@if($child->parent_id == 0 )
									<b>{{ $child->subject }}</b>
									@endif
								</div>
								<span>{{ $child->message }}</span>
								<p>
								@php 
									$creation_date = new \DateTime($child->created_at);
									$interval = $creation_date->diff($current_date);
									if($interval->y > 0)
									{
										echo $interval->y." Year(s) ago by";
									}
									elseif($interval->m > 0)
									{
										echo $interval->m." Month(s) ago by";
									}
									elseif($interval->d > 0)
									{
										echo $interval->d." Day(s) ago by";
									}
									elseif($interval->h > 0)
									{
										echo $interval->h." Hour(s) ago by";
									}
									else
									{
										echo $interval->i." Minute(s) ago by";
									}
								@endphp
								<b class="msg-from">
								@php
									$test = DB::table('users')->select('name')->where('id','=',$child->from_user_id)->first();
									echo $test->name;
								@endphp
								</b> |@if($child->from_user_id != Auth::user()->id)<span class="msg-reply"  data-toggle="modal" data-target="#messageModal" data-profile='<?php echo $formdata; ?>'>Antworten</span>|@endif<span class="msg-delete">Löschen</span></p>
							</div>
						 </div>
							@endforeach
						</div>
						@empty
						<div class="col-lg-12 a-not-found text-center v-h-center">
										<div>
											<h3>You don't have any messages</h3>
										</div>
						</div>
					@endforelse	
					</div>
				</div>
				</div>
			</section>
			<!--message-view-contents end-->
			<!-- Button trigger modal -->


			<!-- Modal -->
			<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header kidwedo-modal-header">
			        <h5 class="modal-title" id="messageModalLabel">REPLY MESSAGE</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
				       <div class="row">
							 <form id="reply_message" method="post" action="{{ route('user_message.post') }}" class="w-100">
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
			        <button type="button" class="kid-btn kid-small-btn kid-cancel-btn" data-dismiss="modal">Close</button>
			        <button type="submit" form="reply_message" class="kid-btn kid-small-btn">Send</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Modal -->

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