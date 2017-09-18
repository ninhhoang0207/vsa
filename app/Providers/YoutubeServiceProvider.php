<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../config/youtube.php');

        $this->publishes([$config => config_path('youtube.php')], 'config');

        $this->mergeConfigFrom($config, 'youtube');

        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');

        if($this->app->config->get('youtube.routes.enabled')) {
            include __DIR__.'/../routes/web.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton('youtube', function($app) {
            return new Youtube($app, new \Google_Client);
        });
    }
}
