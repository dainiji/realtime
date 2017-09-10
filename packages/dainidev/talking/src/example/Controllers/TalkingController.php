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
        $data['userId'] = $request->input('userId');
        $data['userInfo'] = User::where("id",$request->input('userId'))->get()->first();
        $html = View::make('Talking::ajax.friend-request', $data)->render();
        return response()->json(['html' => $html, 'error' => 0]);


    	/**/
    }

    public function submitFriendRequest(Request $request){
        if(Friends::alreadyFriend($request->input('userId'))){
            $message = "You are already friend with ".$request->input('userId');
        } else {
            
            Friends::makeRequest($request->input('userId'),$request->input('reqMsg'));
            $message = "Friend request Sent";
        }
        return response()->json( ['error' => 0, 'message' => $message]); 
    }

    
    public function chatWindow(Request $request){
    	$userId = $request->input('userId');
        $chatUsers  = array(Auth::id(), $userId);

        

        $data['friendshipDetails'] = Friends::getFriendshipDetails($chatUsers);
        
        $data['receiverId'] = $userId;
        $friendName = User::select('name')->where('id','=', $userId)->first();
        $data['friendName'] = $data['receiverName']  = $friendName->name;
        $data['senderName'] = Auth::user()->name;
        $data['chat_id'] = $chat_id = Chat::getChatId($chatUsers);
        $data['messages'] = Message::getMessage($chat_id);

    	$html = View::make('Talking::ajax.chat-window', $data)->render();
    	return response()->json(['html' => $html, 'error' => 0]);
    }
    

    public function confirmFriendRequest(Request $request){
        $input = $request->all();
        //print_r($input);

        $friends = Friends::find($input['friendsId']);
        $friends->status = "1";
        $friends->save();
    }


    public function sendMessage(Request $request){
        $input = $request->all();
        $message = new Message();
        $message->chat_id = $input['chat_id'];
        $message->user_id = Auth::id();
        $message->body = $input['message'];
        $message->save();

    }
    


}
