<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        Gate::define('moderator', function (User $user){
            if ($user->role->name == 'moderator'){
                return true;
            }
        });

        //шлюз для проверки бана
        Gate::define('userIsNotBanned', function (User $user){
            if ($user->ban_status == 0){
                return true;
            }
        });
    }
}
