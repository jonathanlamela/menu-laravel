<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use App\Models\Setting;

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
        Paginator::useBootstrap();

        Category::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        Category::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        $settings = [];

        foreach (Setting::all() as $row) {
            $settings[$row->key] = $row->value;
        }

        view()->share('settings', $settings);
    }
}
