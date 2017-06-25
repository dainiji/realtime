<?php



Route::group(array('prefix' => '/talking'), function(){

	Route::any('/friends', array('as' => 'talking.friends', 'uses' => 'Dainidev\Talking\Controllers\TalkingController@friends'));
	Route::any('/messages', array('as' => 'talking.messages', 'uses' => 'Dainidev\Talking\Controllers\TalkingController@messages'));


});