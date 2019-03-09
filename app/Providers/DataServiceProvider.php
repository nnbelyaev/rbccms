<?php

namespace App\Providers;

use App\Helpers\DataHelper;
use App\Repositories\CachingAuthorRepository;
use App\Repositories\DbAuthorRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DbRubricRepository;
use App\Repositories\DbPublicationRepository;
use App\Repositories\CachingRubricRepository;
use App\Repositories\CachingPublicationRepository;
use Illuminate\Database\Eloquent;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('RubricRepository', function () {
            return new CachingRubricRepository(
                new DbRubricRepository,
                $this->app['cache.store']
            );
        });
        $this->app->singleton('PublicationRepository', function () {
            return new CachingPublicationRepository(
                new DbPublicationRepository,
                $this->app['cache.store']
            );
        });
        $this->app->singleton('AuthorRepository', function () {
            return new CachingAuthorRepository(
                new DbAuthorRepository,
                $this->app['cache.store']
            );
        });
        $this->app->singleton('DataHelper', function () {
            return new DataHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->composer('*', function ($view) {
            $view->with('dataHelper', $this->app->get('DataHelper'));
            $view->with('lang', \App::getLocale());
        });
        $this->app['view']->composer(['manage._shared.navigation','manage.system.group.create','manage.system.group.edit'], function($view) {
            $view->with('allowedResources', $this->app->get('DataHelper')->getAllowedResources());
        });
    }
}