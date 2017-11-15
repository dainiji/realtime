<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
class Chat extends Model
{
    //
    public function sayHello(){
    	echo "I am hello function";
    }

    public static function getChatId($chatUsers){
    	asort($chatUsers);
        $chatUsers = implode("_", $chatUsers); 
        $chat = Chat::where("chat_users", $chatUsers)->get()->first();
        return $chat->id;
    }


    public static function getMyChatList(){
       $participantList = Participant::where('user_id',Auth::id())->get();
        foreach($participantList as $key => $participant){
            $myChatList[$key] = $participant->chat_id;
        }
        return $myChatList;
    }    

}
