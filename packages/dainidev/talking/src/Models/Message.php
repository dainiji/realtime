<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public static function getMessage($chat_id){
    	return Message::where("chat_id", $chat_id)
    		->join('users', 'users.id', '=', 'messages.user_id')
    		->get();

    }
}
