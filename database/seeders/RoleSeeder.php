<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'role' => UserRoleEnum::BaseUser,
                'name' => UserRoleEnum::fromValue(UserRoleEnum::BaseUser)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => UserRoleEnum::Moderator,
                'name' => UserRoleEnum::fromValue(UserRoleEnum::Moderator)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => UserRoleEnum::Administrator,
                'name' => UserRoleEnum::fromValue(UserRoleEnum::Administrator)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => UserRoleEnum::SuperAdministrator,
                'name' => UserRoleEnum::fromValue(UserRoleEnum::SuperAdministrator)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
