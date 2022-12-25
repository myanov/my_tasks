<?php

namespace App\Modules\Admin\Task\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirement_status_id'
    ];

    public function status()
    {
        return $this->belongsTo(RequirementStatus::class, 'requirement_status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function comments()
    {
        return $this->hasMany(RequirementComment::class);
    }
}
