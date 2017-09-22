<div class="row">
	<div class=" col-md-12">
		<ul class="nav nav-tabs nav-justified">
    		<li class="active"><a data-toggle="pill" href="#recentChats" id="recentChatsPill">
    			<i class="fa fa-comments" aria-hidden="true"></i><span class="badge">10</span>
    		</a></li>
    		<li><a data-toggle="pill" href="#friendRequest" id="friendRequestPill">
    			<i class="fa fa-user-plus" aria-hidden="true"></i><span class="badge">3</span>
    		</a></li>
    		<li><a data-toggle="pill" href="#friendSearch">
    			<i class="fa fa-search" aria-hidden="true"></i>
    		</a></li>
  		</ul>

  		<div class="tab-content">
    		<div id="recentChats" class="tab-pane fade in active">
    		  	
    		</div>
    		<div id="friendRequest" class="tab-pane fade">
    		  	<h3>Menu 1</h3>
    		  	<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    		</div>
    		<div id="friendSearch" class="tab-pane fade">
    		  	<input type="text" id="talking-search-txt" class="form-control">
				<button type="button" id="talking-search-btn" class="btn">Search</button>
				<div id="talking-search-result">
				</div>
    		</div>
  		</div>
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


	function getFriends(){
		$.ajax({
			url: "/talking/friends-list",
			dataType: "json",
			type: "post",
			data: {
					
				},

			success: function(data,status,xhr){
				
				
			},
			error: function(xhr){
    	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    	    }
    	});
	}

	function getRequest(){

	}

	function getrecentChats(){
		$.ajax({
			url: "/talking/recent-chats",
			dataType: "json",
			type: "post",
			data: {
					"_token": "{{ csrf_token() }}",
				},
			success: function(data,status,xhr){
				
				$("#recentChats").html(data.html)
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

	$("#recentChatsPill").on('click',function(){
		getrecentChats();
	});

	$(document).ready(function(){
            //alert("I am here");
        getrecentChats();
		socket.emit("update_user_socket", {{ Auth::id() }});
	});
</script>