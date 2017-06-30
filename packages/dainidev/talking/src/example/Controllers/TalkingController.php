<?php

namespace Dainidev\Talking\example\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Dainidev\Talking\Models\Message;
use Dainidev\Talking\Models\Participant;
use Dainidev\Talking\Models\Chat;
use Dainidev\Talking\Models\Friends;



use Config, View, Auth, Redirect ,Response;


class TalkingController extends Controller
{
    
    /*
	Author :  Daini Dev  (daini.developer@gmail.com)
	Return :  Return a view on any page where Jquery / Bootstrap included
    */


	public function initiate(){

    	/*echo "I am initiate function";

    	$friends = Friends::getAllFriends();
    	echo "<pre>";
    	print_r($friends);
    	echo "</pre>"; */
    	return View::make('Talking::index');
	    	
    }

    public function searchFriend(Request $request){


    	$input = $request->all();
    	$data['results'] = Friends::search($request->input('user'));

    	$friends = new Friends();
		$data['friends'] = $friends;
    	
    	$html = View::make('Talking::ajax.search', $data)->render();
		return response()->json(['html' => $html, 'error' => 0]);


    }

    public function sendFriendRequest(Request $request){
    	
    	if(Friends::alreadyFriend($request->input('userId'))){
    		$message = "You are already friend with ".$request->input('userId');
    	} else {
    		
    		Friends::makeRequest($request->input('userId'));
    		$message = "Friend request Sent";
    	}
    	

		return response()->json( ['error' => 0, 'message' => $message]); 	

    }

    
    
    


}
