<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\ShippingSetting;

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
        view()->share('settings', GeneralSetting::first() ?? new GeneralSetting());
    }
}
