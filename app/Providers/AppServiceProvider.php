<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        //

        Blade::include("components.modal-infra", "modalInfra");
        Blade::include("components.modal-login", "modalLogin");
        Blade::include("components.modal-populacao", "modalPopulacao");
    }
}
