function sendFriendRequest(userId){
	alert("Send friend Request to "+userId);
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
					alert(data.message);
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
			$('body').append('<div class="daini_talking">Loading...</div>');
			$('.daini_talking').html(data);

		},

		error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

	
	
});