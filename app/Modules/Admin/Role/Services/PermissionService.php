<?php

namespace App\Modules\Admin\Role\Services;

use App\Modules\Admin\Role\Models\Role;
use Couchbase\KeyValueException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PermissionService
{
    public function save(Request $request)
    {
        $data = $request->except('_token');
        $roles = Role::all();

        /**
         * @var Role $role
         */
        $keysIsNumeric = collect(array_keys($data))->reduce(function ($carry, $item) {
            if (!isset($carry))
            {
                return is_numeric($item);
            }
            return $carry && is_numeric($item);
        });

        if (!$keysIsNumeric)
        {
            throw new \InvalidArgumentException("Ключи должны быть числовыми");
        }

        foreach ($roles as $role) {
            if (isset($data[$role->id]))
            {
                $role->savePermissions($data[$role->id]);
            }
            else
            {
                $role->savePermissions([]);
            }
        }
    }
}
