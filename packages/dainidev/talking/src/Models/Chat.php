<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public function sayHello(){
    	echo "I am hello function";
    }

    public static function getThreadId($chatUsers){
    	asort($chatUsers);
        $chatUsers = implode("_", $chatUsers); 
        $chat = Chat::where("chat_users", $chatUsers)->get()->first();
        return $chat->id;
    }
}
