<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Interfaces\RoomRepositoryInterface',
            'App\Repositories\RoomRepository',
        );
        
        $this->app->bind(
            'App\Repositories\Interfaces\BookingRepositoryInterface',
            'App\Repositories\BookingRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
