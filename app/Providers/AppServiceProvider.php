<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
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
        //
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('UserManager/livewire/update', $handle);
        });
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('UserManager/livewire/livewire.js', $handle);
        });
    }
}
