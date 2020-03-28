<?php

namespace App\Providers;

use App\Http\ViewComposer\CountCartViewComposer;
use App\Http\ViewComposer\SidebarViewComposer;
use Illuminate\Support\Facades\View;
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
        View::composer('frontend.components.sidebar', SidebarViewComposer::class);
        View::composer('frontend.components.cart', CountCartViewComposer::class);
    }
}
