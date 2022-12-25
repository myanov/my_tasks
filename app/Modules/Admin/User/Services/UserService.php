<?php

namespace App\Modules\Admin\User\Services;

use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers()
    {
        $userBuilder = User::with('roles');

        $users = $userBuilder->get();

        $users->transform(function ($user) {
            $user->rolename = '';
            if (isset($user->roles))
            {
                $user->rolename = $user->roles->first()->name ?? '';
            }

            return $user;
        });

        return $users;
    }

    public function save(UserRequest $request, User $user)
    {
        $user->fill($request->only($user->getFillable()));

        if ($request->password)
        {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $role = Role::findOrFail($request->role_id);
        $user->roles()->sync($role->id);

        $user->rolename = $role->name;

        return $user;
    }
}
