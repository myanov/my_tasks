<?php

namespace App\Modules\Admin\Role\Models\Traits;

use App\Modules\Admin\Role\Models\Role;
use Illuminate\Support\Str;

trait UserRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function canDo($alias, $require = false)
    {
        if (is_array($alias))
        {
            foreach ($alias as $permissionAlias) {
                $canDo = $this->canDo($permissionAlias);

                if ($canDo && !$require)
                {
                    return true;
                }
                else if (!$canDo && $require)
                {
                    return false;
                }
            }
        }
        else
        {
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $permission) {
                    if (Str::is($alias, $permission->alias))
                    {
                        return true;
                    }
                }
            }
        }

        return $require;
    }

    public function hasRole($alias, $require = false)
    {
        if (is_array($alias))
        {
            foreach ($alias as $roleAlias) {
                $hasRole = $this->hasRole($roleAlias);

                if ($hasRole && !$require)
                {
                    return true;
                }
                else if (!$hasRole && $require)
                {
                    return false;
                }
            }
        }
        else
        {
            foreach ($this->roles as $role) {
                if (Str::is($alias, $role->alias))
                {
                    return true;
                }
            }
        }

        return $require;
    }

    public function getMergedPermissions()
    {
        $perms = [];

        foreach ($this->getRoles() as $role) {
            $perms = array_merge($perms, $role->permissions->toArray());
        }

        return $perms;
    }

    public function getRoles()
    {
        if ($this->roles)
        {
            return $this->roles;
        }

        return [];
    }
}
