<?php

namespace App\Providers;

use App\Models\DeliveryBoy;
use App\Models\Staff;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
        Gate::define('isAdmin', function ($user) {
            return $user instanceof Staff && $user->isAdmin(); 
        });

        Gate::define('isDeliveryBoy',function ($user){
            return $user instanceof DeliveryBoy;
        });

    }
}
