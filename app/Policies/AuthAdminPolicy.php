<?php

namespace App\Policies;

use App\Enums\UserPermissionsEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthAdminPolicy
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

    public function adminRegister(User $user) {
        return ($user->hasRole(UserRoleEnum::Administrator) || $user->hasRole(UserRoleEnum::SuperAdministrator) || 
            $user->hasPermission(UserPermissionsEnum::ManageAdmin));
    }
}
