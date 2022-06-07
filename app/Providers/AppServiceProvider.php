<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        
        Blade::if('admin', function () {            
            if (auth()->user() && auth()->user()->role == 'admin') {
                return 1;
            }
            return 0;
        });
        Blade::if('user', function () {            
            if (auth()->user() && auth()->user()->role == 'user') {
                return 1;
            }
            return 0;
        });

        //force HTTPS for good reason (?)
        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();
    }
}
