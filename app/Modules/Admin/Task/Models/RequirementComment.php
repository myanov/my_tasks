<?php

namespace App\Modules\Admin\Task\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'target_id',
        'requirement_id'
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
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
