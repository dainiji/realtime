<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //

    public static function updateReadStatus($chat_id,$user_id){
    	Participant::where("chat_id",$chat_id)
    				->where('user_id',$user_id)
    				->update(['last_read' => date('Y-m-d H:i:s') ]);
    }
}
