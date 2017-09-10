
function sendFriendRequest(userId){
	$.ajax({
			url: "/talking/send-friend-request",
			dataType: "json",
			type: "post",
			data: {
					"userId": userId,
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					$(".talking-chat-area").append(data.html)
				}
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    });
}

function submitFriendRequest(userId,reqMsg){
	alert("Submit request for userId "+userId+", request Message "+reqMsg);

	$.ajax({
			url: "/talking/submit-friend-request",
			dataType: "json",
			type: "post",
			data: {
					"userId": userId,
					"reqMsg" : reqMsg,
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					//alert(data.message);
					//$(".talking-chat-area").append(data.html)
				}
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    });
}

function confirmFriendRequest(friendsId){
	$.ajax({
			url: "/talking/confirm-friend-request",
			dataType: "json",
			type: "post",
			data: {
					"friendsId": friendsId,
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					//$(".talking-chat-area").append(data.html)
				}
				
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    });
}


function openChatWindow(userId){
	$.ajax({
			url: "/talking/chat-window",
			dataType: "json",
			type: "post",
			data: {
					"userId": userId,
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					$(".talking-chat-area").append(data.html)
				}
				
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    });
}

//      Send Message    
function sendMessage(chatId, message,senderId,receiverId,senderName, receiverName){

	//alert("here in function chatId : "+chatId+" message : "+ message+" senderId : "+senderId+" receiverId : "+receiverId+" senderName : "+senderName+" receiverName : "+ receiverName)

	

	

	$.ajax({
			url: "/talking/send-message",
			
			type: "post",
			data: {
					"chat_id": chatId,
					"message": message,
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				//Emit this message on server
				socket.emit( 'message', {
					chatId: chatId,
					message: message,
					senderId : senderId,
					receiverId : receiverId,
					senderName : senderName,
					receiverName : receiverName } );
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    });
}


$(document).ready(function(){
		
	$.ajax({
		url: "/talking/initiate", 
		success: function(data,status,xhr){
			$('body').append('<div class="daini-talking">Loading...</div>');
			$('body').append('<div class="talking-chat-area">Loading...</div>');
			$('.daini-talking').html(data);

		},

		error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

    $('textarea').autogrow({onInitialize: true});

	
	
});