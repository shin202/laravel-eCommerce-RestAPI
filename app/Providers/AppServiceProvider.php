<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Relation::enforceMorphMap([
            'product' => 'App\Models\Product',
            'manufacture' => 'App\Models\Manufacture',
            'user' => 'App\Models\User',
        ]);
        Validator::extend('poly_exists', function ($attribute, $value, $parameters, $validator) {
            if (! $type = Arr::get($validator->getData(), $parameters[0], false)) {
                return false;
            }
    
            if (Relation::getMorphedModel($type)) {
                $type = Relation::getMorphedModel($type);
            }
    
            if (! class_exists($type)) {
                return false;
            }
    
            return ! empty(resolve($type)->find($value));
        });
    }
}
