<?php

namespace Jenky\LaravelNotification;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/notification.php';
        $viewsPath = __DIR__.'/../views';
        $assetsPath = __DIR__.'/../assets';

        $this->loadViewsFrom($viewsPath, 'notification');
        $this->publishes([$configPath => config_path('notification.php')], 'config');
        $this->publishes([
            $viewsPath                => base_path('resources/views/vendor/notification'),
            $assetsPath.'/js'         => base_path('resources/assets/notification'),
            __DIR__.'/../migrations/' => $this->app->databasePath(),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/notification.php';

        $this->mergeConfigFrom($configPath, 'notification');

        $this->app->bindShared('notification', function ($app) {
            return new NotificationManager($app);
        });
    }

    public function provides()
    {
        return ['notification'];
    }
}
