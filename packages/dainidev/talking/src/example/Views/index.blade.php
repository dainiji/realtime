


<a href="javascript:void(0)" id="show-talking-search"> Search for a Friend</a>

<div class="talking-search-container" id="talking-search-container">
	<input type="text" id="talking-search-txt" class="form-control">
	<button type="button" id="talking-search-btn" class="btn">Search</button>
	<div id="talking-search-result">

	</div>

</div>

<script type="text/javascript">
	
	function searchFriend(username){
		$.ajax({
			url: "/talking/search-friend",
			dataType: "json",
			type: "post",
			data: {
					"user": username,
					"_token": "{{ csrf_token() }}",
				},

			success: function(data,status,xhr){
				if(data.error == 0){
					$("#talking-search-result").html(data.html);
				}
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    	});
	}


	$("#talking-search-btn").on('click',function(){
		searchFriend($("#talking-search-txt").val());
	});

	$("#show-talking-search").on('click', function(){
		$("#talking-search-container").slideDown();
	});

	$(document).ready(function(){
            //alert("I am here");
		socket.emit("update_user_socket", {{ Auth::id() }});
	});
</script>