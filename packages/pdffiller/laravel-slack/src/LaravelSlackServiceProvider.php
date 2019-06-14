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
        include __DIR__ . '/../routes/api.php';
        $this->app->make('Pdffiller\LaravelSlack\HandleRequestController');
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-slack-plugin.php', 'laravel-slack-plugin');

//        $this->app->singleton('Pdffiller\LaravelSlack\Services\SlackApi', function () {
//            $api = new SlackApi(new Repository(config('laravel-slack-plugin')));
//            return $api;
//        });
//
//        $this->app->singleton('Pdffiller\LaravelSlack\Services\ResponseArrayToObjectBodyConverter', function () {
//            $converter = new ResponseArrayToObjectBodyConverter();
//            return $converter;
//        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-slack-plugin.php' => config_path('laravel-slack-plugin.php'),
        ], 'config');
    }
}
