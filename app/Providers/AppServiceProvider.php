<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Observers\BlogPostObserver;
//use Illuminate\Support\Facades\Schema;//for mariaDB
use App\Observers\BlogCategoryObserver;
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
        //Schema::defaultStringLength(191);//for maria DB

        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
        //
    }
}
