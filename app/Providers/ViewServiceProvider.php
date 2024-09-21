<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\SiteSetting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('frontend.common.navbar', function ($view) {
            $settings = SiteSetting::first();
            $view->with('settings', $settings);
        });
    }

    public function register()
    {
        //
    }
}