<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Friends extends Model
{
    //

    public static function alreadyFriends($user1,$user2){
        if($user1 > $user2){
            $temp =  $user1;
            $user1 = $user2;
            $user2 = $temp;
        }

        

        $list = Friends::where("user1",$user1)->where("user2",$user2)->get()->toArray();
        print_r($list);
        return true;
    }

    public static function friendStatus($user1,$user2){
        if($user1 > $user2){
            $temp =  $user1;
            $user1 = $user2;
            $user2 = $temp;
        }
        $list = Friends::where("user1",$user1)->where("user2",$user2)->get()->toArray();
        print_r($list);
        return true;
    }
}
