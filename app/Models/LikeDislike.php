<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    protected $table = "like_dislike";

    protected $fillable = ['blog_id', 'user_id', 'like_dislike'];

    protected static function boot()
    {
        self::updating(function ($model) {
            $model->setAttribute('user_id', auth()->user()->id);
        });

        Self::creating(function ($model) {
            $model->setAttribute('user_id', auth()->user()->id);
        });
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
