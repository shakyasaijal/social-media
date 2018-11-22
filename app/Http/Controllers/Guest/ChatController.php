<?php

namespace App\Http\Controllers\Guest;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getFriends()
    {
        $friends = Auth::user()->friends();
        return view('chat.friends')->withFriends($friends);
    }

    public function getMyFriend($friend_id){

        $friends = Auth::user()->friends();
        return view('chat.chat-with-friend',['friends'=>$friends,'friend_id'=>$friend_id]);
    }

}
