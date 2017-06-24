<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			Frinds List Page
		</div>
		<div class="col-md-3">
			<table class="table">
				@foreach($allUsers as $user)
				<tr>
					<td>
						{{$user->first_name}} {{$user->last_name}}
					</td>
					<td>
						{{$user->roles[0]->name}}
						<?php //print_r($user->roles) ?>
					</td>
				</tr>
				@endforeach
			</table>
		</div>

		<div class="col-md-6">
			<div class="col-md-6">
				<ul>
				@foreach($allUsers as $user)
					<li data-id="{{$user->id}}" data-name="{{$user->first_name}} {{$user->last_name}}" class="select-user1">
						<a href="javascript:void(0)">{{$user->first_name}} {{$user->last_name}}</a>
					</li>
				@endforeach
				</ul>
			</div>
			<div class="col-md-6">
				@foreach($allUsers as $user)
					<li data-id="{{$user->id}}" data-name="{{$user->first_name}} {{$user->last_name}}" class="select-user2">
						<a href="javascript:void(0)">{{$user->first_name}} {{$user->last_name}}</a>
					</li>
				@endforeach
			</div>
		</div>

		<div class="col-md-3">
			<div id="user1-name" style="border:1px solid #666; width:300px; height:50px">Not Selected</div>
			<div>with</div>
			<div id="user2-name" style="border:1px solid #666; width:300px; height:50px">Not Selected</div>
			<input type="hidden" id="user1">
			<input type="hidden" id="user2">


			<a href="javascript:void(0)" class="btn btn-success" id="submit-request">Make Friend</a>
		</div>

	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$(".select-user1").on("click", function(){
			
			$("#user1").val($(this).attr("data-id"));
			$("#user1-name").html($(this).attr("data-name"));
		});

		$(".select-user2").on("click", function(){
			
			$("#user2").val($(this).attr("data-id"));
			$("#user2-name").html($(this).attr("data-name"));
		});

		$("#submit-request").on("click", function(){
			var user1 = $("#user1").val();
			var user2 = $("#user2").val();
			var action_user = $("#user1").val();


			alert("submit request for " +user1+ " and " +user2 + " action user "+action_user);

			$.ajax({
				url: "{{URL::to('/friends/make-request')}}",
				
				type:'POST',
				//dataType:"json",
				data: {
					"user1": user1,
					"user2": user2,
					"action_user": action_user,
					"_token": "{{ csrf_token() }}",
				},
				success: function(data){
					alert(data);
				}
			});
		});

	});
</script>
</html>