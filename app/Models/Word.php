<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function translations(){
        return $this->hasMany(WordTranslation::class);
    }

    public function wordCategory(){
        return $this->belongsTo(WordCategory::class);
    }

    public function wordType(){
        return $this->belongsTo(WordType::class);
    }
}
