<?php

namespace App\Policies;

use App\Enums\UserPermissionsEnum;
use App\Enums\UserRoleEnum;
use App\Models\Manufacture;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManufacturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacture  $manufacture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Manufacture $manufacture)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return ($user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) || 
            $user->hasPermission(UserPermissionsEnum::CreateManufactures)
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacture  $manufacture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Manufacture $manufacture)
    {
        return ($user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) || 
            $user->hasPermission(UserPermissionsEnum::EditManufactures)
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacture  $manufacture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Manufacture $manufacture)
    {
        return ($user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) || 
            $user->hasPermission(UserPermissionsEnum::DeleteManufactures)
        );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacture  $manufacture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Manufacture $manufacture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacture  $manufacture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Manufacture $manufacture)
    {
        //
    }
}
