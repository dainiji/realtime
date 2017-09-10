var socket = io.connect( 'http://localhost:8080' );

/*$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();
	
	socket.emit( 'message', { name: nameVal, message: msg } );
	
	// Ajax call for saving datas
	$.ajax({
		url: "./ajax/insertNewMessage.php",
		type: "POST",
		data: { name: nameVal, message: msg },
		success: function(data) {
			
		}
	});
	
	return false;
}); */

socket.on( 'new_message', function( data ) {
	//var actualContent = $( "#messages" ).html();
	//var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
	//var content = newMsgContent + actualContent;
	
	//$( "#messages" ).html( content );
	//alert("iam readt get some message");
	html = "<p><b>"+data.senderName+" : </b>"+data.message+"</p>";
	$("#chat_"+data.chatId).find(".msg-list").append(html);


	$("#chat_"+data.chatId).find(".msg-list").animate({
        scrollTop: $("#chat_"+data.chatId).find(".msg-list")[0].scrollHeight}, 2000);

	
});