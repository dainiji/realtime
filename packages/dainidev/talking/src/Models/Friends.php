<?php

namespace Dainidev\Talking\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

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

    public static function makeRequest($userId,reqMsg){
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
                    $status = "Pending";
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

    
    
}
