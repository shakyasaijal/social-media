<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function scopeSearch($query,$search_str){
        return $query->where('title','LIKE',"%{$search_str}%")
                    ->orWhere('posted_date','LIKE',"%{$search_str}%")
                    ->orWhere('description','LIKE',"%{$search_str}%")
                    ->orWhere('status','LIKE',"%{$search_str}%");
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
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

  

    public function pathToPhoto($path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $path_ = $path;
        } else {
            $path_ = $path ? url('/') . '/' . $path : "";
        }
        return $path_;
    }

    public function getFullPhotoPath()
    {
        return $this->pathToPhoto($this->photo);
    }

    public function renderPhoto($class = null)
    {
        if ($class) {
            return '<img src="' . $this->pathToPhoto($this->photo) . '" ' . $class . '/>';
        } else {
            return '<img src="' . $this->pathToPhoto($this->photo) . '" class="img-responsive img-thumbnail"/>';
        }
    }


    public function status()
    {
        if ($this->status === 1) {
            return '<a href="' . route('admin.blog.publish', $this->id) . '"> <span class="label label-sucess"> Publish</span> </a>';
        } else {
            return '<a href="' . route('admin.blog.publish', $this->id) . '"> <span class="label label-danger"> Unpublish</span> </a>';
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likeDislikes()
    {
        return $this->hasMany(LikeDislike::class, 'blog_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'blog_id');
    }


}
