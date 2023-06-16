<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class SentenceTranslation extends Model
{
    protected $table = 'sentences_translation';

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
