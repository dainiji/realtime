<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Friends;
use Config, View, Auth, Helper, URL,Mail, Redirect, Validator,DB,Response,File,Input;
use Dainidev\Talking\Models\Message;
use Dainidev\Talking\Models\Participant;
use Dainidev\Talking\Models\Chat;

class FriendsController extends Controller
{
    public function index(){
    	$data['allUsers'] = User::with('roles')->get();
    	
    	//dd($data['allUsers']);
        $chats = new Chat;

        $chats->sayHello();

    	return View::make('friends.index',$data);
    }


    public function find(){

    }

    public function makeRequest(Request $request){
    	$input = $request->all();
    	print_r($input);
    	
    	
    	if(Friends::alreadyFriends($input['user1'],$input['user2'])){
    		echo "user 1 is already friend  with user 2";
    	} else {
    		echo "Sending request";
    	}

    	/*$friendRequest =  new Friends();
    	if($input['user1'] < $input['user2']){
    		$friendRequest->user1 = $input['user1'];
    		$friendRequest->user2 = $input['user2'];
    	} else {
    		$friendRequest->user1 = $input['user2'];
    		$friendRequest->user2 = $input['user1'];
    	}
    	
    	$friendRequest->action_user_id = $input['user1'];
    	$friendRequest->status = '0';

		$friendRequest->save();    */	

    }
}
