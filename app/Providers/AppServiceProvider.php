<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Models\Validador;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fuerza el uso de HTTPS en produccion
        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();

        Validator::extend('validar_cedula', function($attribute, $cedula, $parameters, $validator) {
            return Validador::validarCedula($cedula);
        });

    }
}
