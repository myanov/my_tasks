<?php

namespace App\Modules\Admin\User\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user) : bool
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'USER_ACCESS', 'USERS_REED']);
    }

    public function create(User $user) : bool
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'USER_ACCESS', 'USERS_CREATE']);
    }

    public function edit(User $user) : bool
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'USER_ACCESS', 'USERS_EDIT']);
    }

    public function delete(User $user) : bool
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'USER_ACCESS', 'USERS_DELETE']);
    }
}
