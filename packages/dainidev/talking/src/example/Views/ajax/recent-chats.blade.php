<meta name="_token" content="{{ csrf_token() }}">
<ul id="talking-search-list">
	@foreach($recentChatfirends as $user)

		
		@if($friendsObj->alreadyFriend($user->id) == "Accepted")
			<li><a href="javascript:void(0)" onclick="openChatWindow({{$user->id}})">{{$user->name}} / {{$user->email}}</a></li>
		@else
			<li><a href="javascript:void(0)" onclick="openChatWindow({{$user->id}})">{{$user->name}} / {{$user->email}}</a> {{$friendsObj->alreadyFriend($user->id)}}</li>
		@endif
		
	@endforeach
</ul>