<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function scopeSearch($query,$search_query){
        return $query->where('comment','LIKE',"%{$search_query}%")
                ->orWhereHas('user',function($query) use($search_query){
                    $query->where('name','LIKE',"{$search_query}");
                });
    }

    protected $table = "comments";

    protected $appends = ['reply_box'];

    public function getReplyBoxAttribute(){
        return false;
    }

    public static function boot()
    {
        self::updating(function ($model) {
            $model->setAttribute('user_id', auth()->user()->id);
        });

        Self::creating(function ($model) {
            $model->setAttribute('user_id', auth()->user()->id);
        });
    }

    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id');
    }

    protected $fillable = ['blog_id', 'user_id', 'comment', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
