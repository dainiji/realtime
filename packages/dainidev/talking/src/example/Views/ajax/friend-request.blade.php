<div class="talking-chat-window">
	<div class="chat-box">
		<div class="chat-header">
			<div class="chat-status"></div>
			<div class="chat-friend">Daini</div>
		</div>
		<div class="req-message-list">

			<h3>Add {{$userInfo->first_name}} {{$userInfo->last_name}} as friend</h3>
			<h4>Type a message</h4>
		</div>
		<div class="new-msg">
			<textarea class="form-control friend-request-msg " style="overflow:hidden">Hello {{$userInfo->first_name}} {{$userInfo->last_name}}, I want to add you as friend.</textarea>
			<button class="btn btn-primary send-friend-request" ><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	/* 
		onclick="submitFriendRequest({{$userInfo->id}})"
	*/
	$(document).ready(function(){
		alert("I am ready");
		$(".send-friend-request").on("click", function(){
			var reqMsg = $( this ).parent().find(".friend-request-msg").text();
			alert("Send Now "+reqMsg);
			submitFriendRequest( {{$userInfo->id}}, reqMsg, );
		});
	});
</script>
