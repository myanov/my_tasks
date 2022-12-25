<?php

namespace App\Modules\Admin\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias'
    ];

    public function tasks()
    {
        // TODO вроде как не нужно передавать второй аргумент, потому что TaskCategory дложно будет превратиться в task_category_id
        return $this->hasMany(Task::class);
    }
}
