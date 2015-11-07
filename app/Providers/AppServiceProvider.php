<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            base_path().'/vendor/twbs/bootstrap/dist' => public_path('vendor/bootstrap'),
            base_path().'/vendor/components/font-awesome' => public_path('vendor/font-awesome'),
            base_path().'/vendor/components/jquery' => public_path('vendor/jquery')
        ],'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
