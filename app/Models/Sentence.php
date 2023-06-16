<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    public function translations(){
        return $this->hasMany(SentenceTranslation::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
