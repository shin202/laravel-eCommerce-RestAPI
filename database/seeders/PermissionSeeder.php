<?php

namespace Database\Seeders;

use App\Enums\UserPermissionsEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'permission' => UserPermissionsEnum::ViewProducts,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProducts)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateProducts,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateProducts)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditProducts,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditProducts)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteProducts,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteProducts)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewManufactures,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewManufactures)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateManufactures,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateManufactures)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditManufactures,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditManufactures)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteManufactures,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteManufactures)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewProductCategories,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProductCategories)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditProductCategories,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditProductCategories)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateProductCategories,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateProductCategories)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteProductCategories,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteProductCategories)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewProductColors,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProductColors)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateProductColors,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateProductColors)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditProductColors,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditProductColors)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteProductColors,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteProductColors)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewProductSizes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProductSizes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateProductSizes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateProductSizes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditProductSizes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditProductSizes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteProductSizes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteProductSizes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewProductTypes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProductTypes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CreateProductTypes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CreateProductTypes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditProductTypes,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditProductTypes)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::PlaceOrder,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::PlaceOrder)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ViewOrder,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewOrder)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CheckingOrder,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CheckingOrder)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::CancelOrder,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::CancelOrder)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteOrder,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteOrder)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ReadComments,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ReadComments)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditComments,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditComments)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::WriteComments,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::WriteComments)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteComments,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteComments)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::Rating,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::Rating)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::EditRating,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::EditRating)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::DeleteRating,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::DeleteRating)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ManageSystem,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ManageSystem)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ManageUser,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ManageUser)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ManageAdmin,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ManageAdmin)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'permission' => UserPermissionsEnum::ManageAuthorize,
                'name' => UserPermissionsEnum::fromValue(UserPermissionsEnum::ManageAuthorize)->key,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
