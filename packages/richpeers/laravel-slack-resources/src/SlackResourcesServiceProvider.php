<?php

namespace Richpeers\LaravelSlackResources;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Richpeers\LaravelSlackResources\Http\Middleware\SlackSigningSecretMiddleware;

class SlackResourcesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // load config
        $this->mergeConfigFrom(
            __DIR__ . '/config/slack-resources.php', 'slack-resources'
        );
    }

    /**
     * Bootstrap services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        // enable publishing config for overriding default
        $this->publishes([
            __DIR__ . '/config/slack-resources.php' => config('slack-resources.php')
        ]);

        // load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // add middleware
        $router->aliasMiddleware('slack-resource', SlackSigningSecretMiddleware::class);

        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
    }
}
