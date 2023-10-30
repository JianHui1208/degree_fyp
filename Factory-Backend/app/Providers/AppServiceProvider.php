<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\View;

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
        // $setting = GlobalSetting::where('key', 'users_regisration')->first();
        // View::share('users_regisration', $setting->value);
    }
}
