<?php

namespace App\Modules\Admin\Task\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequirementPolicy
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

    public function view(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'REQUIREMENTS_VIEW', 'REQUIREMENTS_ACCESS']);
    }

    public function create(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'REQUIREMENTS_CREATE', 'REQUIREMENTS_ACCESS']);
    }

    public function edit(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'REQUIREMENTS_EDIT', 'REQUIREMENTS_ACCESS']);
    }

    public function delete(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR', 'REQUIREMENTS_DELETE', 'REQUIREMENTS_ACCESS']);
    }
}
