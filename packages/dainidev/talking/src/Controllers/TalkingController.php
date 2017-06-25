<?php

namespace Dainidev\Talking\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class TalkingController extends Controller
{
    public function friends(){
    	$alluser = User::get();
    	dd($alluser);
    	//echo "I am TalkingController Friends Function";
    	//return view('Talking::index');
    }

    public function messages(){
    	echo "I am TalkingController messages Function";
    }
}
