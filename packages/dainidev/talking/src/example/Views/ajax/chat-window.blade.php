<div class="talking-chat-window" id="chat_{{$chat_id}}">
	<div class="chat-box">
		<div class="chat-header">
			<div class="chat-status"></div>
			<div class="chat-friend">{{$friendName}}</div>
		</div>
		<div class="msg-list">
			@foreach($messages as $message)
				
				<p><b>{{$message->name}} : </b>{{$message->body}}</p>
			@endforeach
		</div>


		@if($friendshipDetails->status == '1')
		<div class="new-msg">
			<textarea rows="4"></textarea>
			<input type="hidden" class="chatId" value="{{$chat_id}}">
			<input type="hidden" class="senderId" value="{{Auth::id()}}">
			<input type="hidden" class="receiverId" value="{{$receiverId}}">
			<input type="hidden" class="senderName" value="{{$senderName}}">
			<input type="hidden" class="receiverName" value="{{$receiverName}}">

			<a href="javascript:void(0)" class="btn btn-default btn-sm send-button" >Send</a>
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
		var message = $(this).parent().find("textarea").val();
		var chatId = $(this).parent().find(".chatId").val();
		var senderId = $(this).parent().find(".senderId").val();
		var senderName = $(this).parent().find(".senderName").val();
		var receiverId = $(this).parent().find(".receiverId").val();
		var receiverName = $(this).parent().find(".receiverName").val();
		

		
		sendMessage(chatId, message,senderId,receiverId,senderName, receiverName);

	});
</script>