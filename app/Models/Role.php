<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_role', 'user_id', 'role_id')->withTimestamps();
    }
}
