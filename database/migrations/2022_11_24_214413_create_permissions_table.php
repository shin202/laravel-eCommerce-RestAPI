<?php

use App\Enums\UserPermissionsEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('permission')->comment('UserPermissionEnum')->index()->default(UserPermissionsEnum::ViewProducts);
            $table->string('name')->default(UserPermissionsEnum::fromValue(UserPermissionsEnum::ViewProducts)->key);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
