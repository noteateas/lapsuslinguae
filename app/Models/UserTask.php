<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    protected $table = 'user_task';

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
