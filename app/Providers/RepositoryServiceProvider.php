<?php

namespace App\Providers;

use App\Domains\Roles\Contracts\RoleRepositoryInterface;
use App\Domains\Roles\Repositories\EloquentRoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
    }

    public function boot(): void {}
}
