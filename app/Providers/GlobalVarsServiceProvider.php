<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

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
        $settings = [];

        foreach (Setting::all() as $row) {
            $settings[$row->key] = $row->value;
        }

        view()->share('settings', $settings);
    }
}
