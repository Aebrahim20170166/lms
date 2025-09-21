<?php

namespace App\Providers;

use App\Domains\Cities\Contracts\CityInterface;
use App\Domains\Cities\Repositories\CityRepository;
use App\Domains\Countries\Contracts\CountryInterface;
use App\Domains\Countries\Repositories\CountryRepository;
use App\Domains\Enrollments\Contracts\EnrollmentRepositoryInterface;
use App\Domains\Enrollments\Repositories\EloquentEnrollmentRepository;
use App\Domains\Courses\Contracts\CourseInterface;
use App\Domains\Courses\Repositories\CourseRepository;
use App\Domains\Lessons\Contracts\LessonInterface;
use App\Domains\Lessons\Repositories\LessonRepository;
use App\Domains\Levels\Contracts\LevelInterface;
use App\Domains\Levels\Repositories\LevelRepository;
use App\Domains\Roles\Contracts\RoleRepositoryInterface;
use App\Domains\Roles\Repositories\EloquentRoleRepository;
use App\Domains\Students\Contracts\StudentInterface;
use App\Domains\Students\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // bind Role Interface to Role Repository
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
        // bind Country Interface to Country Repository
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        // bind City Interface to City Repository
        $this->app->bind(CityInterface::class, CityRepository::class);
        // bind Enrollment Interface to Enrollment Repository
        $this->app->bind(EnrollmentRepositoryInterface::class, EloquentEnrollmentRepository::class);

        // bind Level Interface to Level Repository
        $this->app->bind(LevelInterface::class, LevelRepository::class);

        // bind Course Interface to Course Repository
        $this->app->bind(CourseInterface::class, CourseRepository::class);
        
        // bind Lesson Interface to Lesson Repository
        $this->app->bind(LessonInterface::class, LessonRepository::class);

        //bind Student Interface to Student Repository
        $this->app->bind(StudentInterface::class, StudentRepository::class);

    }

    public function boot(): void {}
}
