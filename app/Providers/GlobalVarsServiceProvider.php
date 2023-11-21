<?php

namespace App\Providers;

use App\Classes\Cart;
use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Settings;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\Schema;

class GlobalVarsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            view()->share('settings', Settings::first() ?? new Settings());
        }
    }
}
