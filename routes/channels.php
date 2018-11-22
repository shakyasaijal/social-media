<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/*$user->id == (int) $friend_id;*/
Broadcast::channel('chat.{user_id}.{friend_id}',function($user,$user_id,$friend_id){
    return $user->id === (int) $friend_id;
});

//channel for online users
Broadcast::channel('online',function($user){
    return $user;
});
