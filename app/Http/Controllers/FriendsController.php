<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Config, View, Auth, Helper, URL,Mail, Redirect, Validator,DB,Response,File,Input;
use Dainidev\Talking\Models\Message;
use Dainidev\Talking\Models\Participant;
use Dainidev\Talking\Models\Chat;
use Dainidev\Talking\Models\Friends;

class FriendsController extends Controller
{
    public function indexTest(){
    	$data['allUsers'] = User::with('roles')->get();
    	
    	//dd($data['allUsers']);
        $chats = new Chat;

        $chats->sayHello();

    	return View::make('friends.index',$data);
    }

    public function index(){
        return View::make('friends.index');
    }


    

    
}
