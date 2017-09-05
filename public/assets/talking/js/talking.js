$('textarea').autogrow({onInitialize: true});
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

function submitFriendRequest(reqMsg,userId){
	//alert("Submit request for userId"+userId);
	$.ajax({
			url: "/talking/submit-friend-request",
			dataType: "json",
			type: "post",
			data: {
					"userId": userId,
					"reqMsg" : reqMsg;
					"_token": $('meta[name="_token"]').attr('content'),
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					alert(data.message);
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

	
	
});