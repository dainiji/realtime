<?php



Route::group(array('prefix' => '/talking'), function(){

	
	// This function is for initiate talking example
	Route::any('/initiate', array('as' => 'talking.initiate', 'uses' => 'Dainidev\Talking\example\Controllers\TalkingController@initiate'))->middleware('web')->middleware('talking');
	

	Route::post('/search-friend', array('as' => 'talking.search-friend', 'uses' => 'Dainidev\Talking\example\Controllers\TalkingController@searchFriend'))->middleware('web')->middleware('talking');
	
	Route::any('/send-friend-request', array('as' => 'talking.send-friend-request', 'uses' => 'Dainidev\Talking\example\Controllers\TalkingController@sendFriendRequest'))->middleware('web')->middleware('talking');
	

});