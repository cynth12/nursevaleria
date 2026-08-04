<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
    Paginator::useBootstrap();

     /*
     * Acceso completo para todos los usuarios
     * que no sean enfermeros de turno.
     */
    Gate::define('full-access', function (User $user): bool {
        return !$user->is_shift_nurse;
    });

    /*
     * La lista de pacientes puede verla cualquier usuario autenticado.
     */
    Gate::define('view-patients', function (User $user): bool {
        return true;
    });
}


}
