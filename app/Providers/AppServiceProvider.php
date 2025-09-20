<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Countries\Contracts\CountryInterface::class,
            \App\Domains\Countries\Repositories\CountryRepository::class,
        );

        $this->app->bind(
            \App\Domains\Cities\Contracts\CityInterface::class,
            \App\Domains\Cities\Repositories\CityRepository::class,
        );

        $this->app->bind(
            \App\Domains\Levels\Contracts\LevelInterface::class,
            \App\Domains\Levels\Repositories\LevelRepository::class,
        );

        $this->app->bind(
            \App\Domains\Courses\Contracts\CourseInterface::class,
            \App\Domains\Courses\Repositories\CourseRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
