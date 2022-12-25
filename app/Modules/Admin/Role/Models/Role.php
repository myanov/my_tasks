<?php

namespace App\Modules\Admin\Role\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function savePermissions($perms) : void
    {
        if (!empty($perms))
        {
            $this->permissions()->sync($perms);
        }
        else
        {
            $this->permissions()->detach();
        }
    }

    public function hasPermission($alias, $require = false) : bool
    {
        if (is_array($alias))
        {
            foreach ($alias as $permissionAlias) {
                $hasPermission = $this->hasPermission($permissionAlias);
                if ($hasPermission && !$require)
                {
                    return true;
                }
                else if (!$hasPermission && $require)
                {
                    return false;
                }
            }
        }
        else
        {
            foreach ($this->permissions as $permission) {
                if ($permission->alias === $alias)
                {
                    return true;
                }
            }
        }

        return $require;
    }
}
