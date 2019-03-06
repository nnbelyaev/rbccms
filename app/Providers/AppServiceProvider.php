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
        if (isset($_SERVER['HTTP_HOST'])) {
            \Log::info("REQUESTED URL", ["http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \DB::listen(function ($query) {
            \Log::info('SQL', [
                $query->sql,
                $query->bindings,
                $query->time
            ]);
        });
    }
}
