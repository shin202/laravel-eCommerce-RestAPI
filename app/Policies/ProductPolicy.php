<?php

namespace App\Policies;

use App\Enums\UserPermissionsEnum;
use App\Enums\UserRoleEnum;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    protected $message;

    public function __construct()
    {
        $this->message = 'Quyền truy cập bị từ chối. Nếu đây là sự cố, vui lòng liên hệ với chủ sở hữu để được hỗ trợ.';
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return ($user->hasRole(UserRoleEnum::BaseUser) || $user->hasPermission(UserPermissionsEnum::ViewProducts));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Product $product)
    {
        return ($user->hasRole(UserRoleEnum::BaseUser) || $user->hasPermission(UserPermissionsEnum::ViewProducts));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return (
            $user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) ||
            $user->hasPermission(UserPermissionsEnum::CreateProducts)
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Product $product)
    {
        return (
            $user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) ||
            $user->hasPermission(UserPermissionsEnum::EditProducts)
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Product $product)
    {
        return (
            $user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) ||
            $user->hasPermission(UserPermissionsEnum::DeleteProducts)
        );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }

    public function manageImage(User $user, Product $product) {
        return (
            $user->hasRole(UserRoleEnum::Administrator) || 
            $user->hasRole(UserRoleEnum::SuperAdministrator) ||
            $user->hasPermission(UserPermissionsEnum::EditProducts)
        ) ? Response::allow() : Response::deny($this->message);
    }
}
