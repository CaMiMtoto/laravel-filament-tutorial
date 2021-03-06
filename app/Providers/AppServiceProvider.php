<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Shop',
                'Blog',
                'Settings',
            ]);
            Filament::registerTheme(mix('css/filament.css'));
        });
    }
}
