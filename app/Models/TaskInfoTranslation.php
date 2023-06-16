<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskInfoTranslation extends Model
{
    use HasFactory;

    protected $table = 'task_info_translation';

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
