
<div class="row">
	
	<div class="col-md-3">	
		<a href="javascript:void(0)" class="friendList">
			<i class="fa fa-users" aria-hidden="true"></i>
		</a>		
	</div>

	<div class="col-md-3">
		<a href="javascript:void(0)" class="friendRequest">
			<i class="fa fa-user-plus" aria-hidden="true"></i><span class="badge">3</span>
		</a>
	</div>

	<div class="col-md-3">
		<a href="javascript:void(0)" class="unreadMessage">
			<i class="fa fa-comments" aria-hidden="true"></i><span class="badge">10</span>
		</a>
	</div>
	
	<div class="col-md-3">
		<a href="javascript:void(0)" class="searchFriend" id="show-talking-search">
			<i class="fa fa-search" aria-hidden="true"></i>
		</a>
	</div>
	
</div>




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