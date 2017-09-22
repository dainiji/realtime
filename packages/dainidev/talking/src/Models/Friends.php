<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

use Dainidev\Talking\Models\Message;
use Dainidev\Talking\Models\Participant;
use Dainidev\Talking\Models\Chat;

class Friends extends Model
{
    //


    public static function getAllFriends(){
        $userId = Auth::id();
        $list = Friends::where("user1",$userId)->where("user2",$userId)->get()->toArray();
    }

    public static function getAllFriendsById($userid){
        $list = Friends::where("user1",$userId)->where("user2",$userId)->get()->toArray();
    }

    public static function search($user){

        $result = User::where('email','like', "%".$user."%")->get();
        return $result;
    }

    public static function makeRequest($userId,$reqMsg){
        $user1 = Auth::id();
        $user2 = $userId;

        $friendRequest =  new Friends();
        if($user1 < $user2){ //User1 Id should be less then user2
            $friendRequest->user1 = $user1;
            $friendRequest->user2 = $user2;
        } else {
            $friendRequest->user1 = $user2;
            $friendRequest->user2 = $user1;
        }
        
        $friendRequest->action_user_id = $user1;
        $friendRequest->status = '0';

        $friendRequest->save(); 

        Friends::createChat($userId,$reqMsg);        





    }


    public static function alreadyFriend($userId){
        $user1 = Auth::id();
        $user2 = $userId;

        if($user1 > $user2){  // Swap user1 and user2
            $temp =  $user1;
            $user1 = $user2;
            $user2 = $temp;
        }

        $result = Friends::where("user1",$user1)->where("user2",$user2)->get();
        //print_r($result);
        if($result->count() > 0){
            
            switch($result[0]->status){
                case '0':
                	if($result[0]->action_user_id == Auth::id()){
                		$status = "Pending";
                	} else {
                		$status = "Request";
                	}
                    
                break;

                case '1':
                    $status = "Accepted";
                break;

                case '2':
                    $status = "Declined";
                break;

                case '3':
                    $status = "Blocked";
                break;

            }

            return $status;
        } else {
            return false;
        }

    }


    
    public static function createChat($userId,$reqMsg){
        

        //Create chat / Message Thread
        

        $chat = new Chat();
        $chat->subject = Auth::user()->name." and ".User::find($userId)->name;
        $chat->chat_users = Friends::makeChatUsers($userId);
        $chat->save();

        //Save Particepent in chat 
        //*********************************************************************
        // Saving Particepent 1
        $participant1 = new Participant();
        $participant1->chat_id = $chat->id;
        $participant1->user_id = Auth::id();
        $participant1->last_read = date("YYYY-MM-DD HH:MM:SS");
        $participant1->save();

        // Saving Particepent 2
        $participant2 = new Participant();
        $participant2->chat_id = $chat->id;
        $participant2->user_id = $userId;
        $participant2->save();
        //*********************************************************************

        //Save Message
        //*********************************************************************
        $message = new Message();
        $message->chat_id = $chat->id;
        $message->user_id = Auth::id();
        $message->body = $reqMsg;
        $message->save();
        //*********************************************************************

    }
    

    public static function makeChatUsers($recipients){
        
        $sender_id = Auth::id();

        $participants = array();
        $participants[0] = $sender_id;
        if(!is_array($recipients)) {
            $participants[1] = $recipients;
        } else  {
            $participants = array_merge($participants, $recipients);  
        }

        $participants = array_unique($participants);

        asort($participants);

        $participants = implode("_", $participants); 

        return $participants;
    }


    public static function getFriendshipDetails($chatUsers){
        sort($chatUsers);
        return Friends::where("user1",$chatUsers[0])->where("user2",$chatUsers[1])->get()->first();
        
    }

}
