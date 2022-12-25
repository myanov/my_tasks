<?php

namespace App\Modules\Admin\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias',
        'description'
    ];

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
}
