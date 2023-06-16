<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function translations(){
        return $this->hasMany(TaskTranslation::class);
    }
}
