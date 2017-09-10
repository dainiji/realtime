var socket = io.connect( 'http://localhost:8080' );


socket.on( 'new_message', function( data ) {
	html = "<p><b>"+data.senderName+" : </b>"+data.message+"</p>";
	$("#chat_"+data.chatId).find(".msg-list").append(html);
	
	
	if($("#chat_"+data.chatId).length ){
		$("#chat_"+data.chatId).find(".msg-list").animate({
        scrollTop: $("#chat_"+data.chatId).find(".msg-list")[0].scrollHeight}, 2000);
	} else {
		alert('you have new message open chat box');
	}
	
	
});