<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userActions(){
        return $this->hasMany(UserAction::class);
    }

    public function userTasks(){
        return $this->hasMany(UserTask::class);
    }

    public function userProgress(){
        return $this->hasMany(UserProgress::class);
    }
}
