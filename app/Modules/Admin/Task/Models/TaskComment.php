<?php

namespace App\Modules\Admin\Task\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'target_id',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function target()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
