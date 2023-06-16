<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
