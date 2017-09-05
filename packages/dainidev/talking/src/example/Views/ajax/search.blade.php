<meta name="_token" content="{{ csrf_token() }}">
<ul id="talking-search-list">
	@foreach($results as $user)
		@if($friends->alreadyFriend($user->id))
			
			<li><a href="javascript:void(0)" onclick="openChatWindow({{$user->id}})">{{$user->name}} / {{$user->email}}</a> {{$friends->alreadyFriend($user->id)}}</li>
		@else
			<li><a href="javascript:void(0)" onclick="sendFriendRequest({{$user->id}})">{{$user->name}} / {{$user->email}}</a></li>
		@endif
	@endforeach
</ul>