<?php

namespace App\Models;

use App\Events\BroadcastMessage;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['user_id','friend_id','message'];

    public function getCreatedAtAttribute($val){
        return $val?date('M d, Y H:i:s',strtotime($val)):null;
    }


}
