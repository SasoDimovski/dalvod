<?php

namespace App\Providers;

use App\Models\Projects;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Providers\AuthServiceProvider;
use Modules\Groups\Providers\GroupsServiceProvider;
use Modules\Languages\Providers\LanguagesServiceProvider;
use Modules\Main\Providers\MainServiceProvider;
use Modules\Modules\Providers\ModulesServiceProvider;
use Modules\Projects\Providers\ProjectsServiceProvider;
use Modules\User\Providers\UserServiceProvider;
use Modules\Users\Providers\UsersServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(UsersServiceProvider::class);
        $this->app->register(MainServiceProvider::class);
        $this->app->register(LanguagesServiceProvider::class);
        $this->app->register(ModulesServiceProvider::class);
        $this->app->register(GroupsServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->app->register(ProjectsServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
