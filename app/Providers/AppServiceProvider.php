<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

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

        Paginator::useTailwind();

        Category::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        Category::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }
}
