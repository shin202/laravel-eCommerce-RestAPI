<?php

namespace App\Models;

use App\Enums\UserPermissionsEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $permissionList = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the user's avatars.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function avatar()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Get the roles that belong to the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    // Authorization User

    /**
     * Check if user has role.
     * 
     * @param \App\Enums\UserRoleEnum $role
     * @return mixed
     */
    public function hasRole($role)
    {
        if ($role) return $this->roles->contains('role', $role);

        return false;
    }

    /**
     * Check if user has permission.
     * 
     * @param \App\Enums\UserPermissionsEnum|null $permission
     * @return mixed
     */
    public function hasPermission($permission = null)
    {
        if (is_null($permission)) {
            return $this->getPermissions()->count() > 0;
        }

        return $this->getPermissions()->contains('permission', $permission);
    }

    /**
     * Get permission list of the role.
     * 
     * @return mixed
     */
    private function getPermissions()
    {
        $role = $this->roles->first();

        if ($role) {
            if (!$role->relationLoaded('permissions')) {
                $role->load('permissions');
            }

            $this->permissionList = $this->roles->pluck('permissions')->flatten();
        }

        return $this->permissionList ?? collect();
    }

    public function isAdministrator() {
        return ($this->hasRole(UserRoleEnum::Administrator) || $this->hasRole(UserRoleEnum::SuperAdministrator));
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return is_numeric($value)
            ? $this->where('id', $value)->firstOrFail()
            : $this->where('username', $value)->firstOrFail();
    }
}
