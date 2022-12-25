<?php

namespace App\Modules\Admin\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias',
        'description'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
