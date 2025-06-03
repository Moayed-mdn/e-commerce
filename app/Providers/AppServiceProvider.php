<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Staff;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::getAccessTokenFromRequestUsing(function($request) {
            
            return    $request->bearerToken() ?? $request->cookie('token') ;
             
        });

        
        
        


    }
}
