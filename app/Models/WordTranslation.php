<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordTranslation extends Model
{
    protected $table = 'words_translations';

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
