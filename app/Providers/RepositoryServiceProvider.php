<?php

namespace App\Providers;

use App\Domains\Cities\Contracts\CityInterface;
use App\Domains\Cities\Repositories\CityRepository;
use App\Domains\Countries\Contracts\CountryInterface;
use App\Domains\Countries\Repositories\CountryRepository;
use App\Domains\Courses\Contracts\CourseInterface;
use App\Domains\Courses\Repositories\CourseRepository;
use App\Domains\Levels\Contracts\LevelInterface;
use App\Domains\Levels\Repositories\LevelRepository;
use App\Domains\Roles\Contracts\RoleRepositoryInterface;
use App\Domains\Roles\Repositories\EloquentRoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
        // bind Country Interface to Country Repository
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        // bind City Interface to City Repository
        $this->app->bind(CityInterface::class, CityRepository::class);

        // bind Level Interface to Level Repository
        $this->app->bind(LevelInterface::class, LevelRepository::class);

        // bind Course Interface to Course Repository
        $this->app->bind(CourseInterface::class, CourseRepository::class);
    }

    public function boot(): void {}
}
