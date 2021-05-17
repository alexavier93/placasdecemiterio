<?php

namespace App\Providers;

use App\Models\Order;
use Facade\FlareClient\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('*', function($view){
            $lastOrders = Order::all()->take(3);
            $view->with('lastOrders', $lastOrders);
        });

    }
}
