<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskInfo extends Model
{
    use HasFactory;

    protected $table = 'task_info';

    public function translations(){
        return $this->hasMany(TaskInfoTranslation::class);
    }

}
