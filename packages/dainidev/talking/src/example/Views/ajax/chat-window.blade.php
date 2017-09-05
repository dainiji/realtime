<div class="talking-chat-window">
	<div class="chat-box">
		<div class="chat-header">
			<div class="chat-status"></div>
			<div class="chat-friend">Daini</div>
		</div>
		<div class="msg-list">
			@foreach($messages as $message)
				
				<p><b>{{$message->name}} : </b>{{$message->body}}</p>
			@endforeach
		</div>


		@if($friendshipDetails->status == '1')
		<div class="new-msg">
			<textarea rows="4"></textarea>

			<a href="javascript:void(0)" class="btn btn-default btn-sm send-button" chatId="{{$chat_id}}">Send</a>
		</div>
		@else 
			@if($friendshipDetails->status == '0' && $friendshipDetails->action_user_id == Auth::id())
				<div>Waiting For Confirmation</div>
			@else
				<div><a class="btn btn-success" onclick="confirmFriendRequest('{{$friendshipDetails->id}}')">Confirm</a></div>
			@endif
		@endif
	</div>
</div>
<script type="text/javascript">
	$(".send-button").on('click', function(){
		var chat_id = $(this).attr('chatId');
		var message = $(this).parent().find("textarea").val();
		
		//alert("message : "+message+" chat_id : "+chat_id);
		sendMessage(chat_id, message);

	});
</script>