<?php

namespace Pdffiller\LaravelSlack;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Pdffiller\LaravelSlack\Services\ResponseArrayToObjectBodyConverter;
use Pdffiller\LaravelSlack\Services\SlackApi;

class LaravelSlackServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->publishes([
            __DIR__ . '/../config/laravel-slack-plugin.php' => config_path('laravel-slack-plugin.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
