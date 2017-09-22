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
        Message::saveMessage($input['chat_id'],$input['message']);
    }

    public function recentChats(){

        $participantList = Participant::where('user_id',Auth::id())->get();

        //echo "<pre>";
        //print_r($participantList);
        //echo "</pre>";

        //$chats = array();
        foreach($participantList as $key => $participant){
            $chats[$key] = $participant->chat_id;
        }
        //print_r($chats);

        $recentChatList = Chat::whereIn('id',$chats)->orderBy('updated_at','desc')->get();

        foreach($recentChatList as $key => $chat){
            //echo $chat->id.", ";

            $friends[$key] = Participant::where('chat_id',$chat->id)
                                    ->where('user_id',"!=",Auth::id())
                                    ->join('users',"participants.user_id","=","users.id")
                                    ->get()->first();
        }
        //print_r($recentChatList);

        //echo "<pre>";
        //print_r($friends);

        foreach ($friends as $key => $friend) {
            # code...
            //echo $friend->name."<br/>";
        }

        $data['recentChatfirends'] = $friends;

        $friendsObj = new Friends();
		$data['friendsObj'] = $friendsObj;

        $html = View::make('Talking::ajax.recent-chats', $data)->render();
        //echo $html;
		return response()->json(['html' => $html, 'error' => 0]);
        
    }
    
    

}
