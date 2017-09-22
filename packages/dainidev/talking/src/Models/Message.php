<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;
use Dainidev\Talking\Models\Participant;
use Auth;

class Message extends Model
{
    //
    public static function getMessage($chat_id){
    	return Message::where("chat_id", $chat_id)
    		->join('users', 'users.id', '=', 'messages.user_id')
    		->get();

    }

    public static function saveMessage($chat_id,$body){
    	//echo $message;
    	$message = new Message();
        $message->chat_id = $chat_id;
        $message->user_id = Auth::id();
        $message->body = $body;
        $message->save();

        Participant::updateReadStatus($chat_id,Auth::id());

        $chat = Chat::find($chat_id);
        $chat->touch();
    }
}
