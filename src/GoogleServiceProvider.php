<?php

namespace Solarios\Google;

use Solarios\Google\Authenticators\AuthenticatorFactory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/google.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('google.php')]);
        }

        $this->mergeConfigFrom($source, 'google');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAuthFactory();
        $this->registerGoogleFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the auth factory class.
     *
     * @return void
     */
    protected function registerAuthFactory()
    {
        $this->app->singleton('google.authfactory', function () {
            return new AuthenticatorFactory();
        });

        $this->app->alias('google.authfactory', AuthenticatorFactory::class);
    }

    /**
     * Register the google factory class.
     *
     * @return void
     */
    protected function registerGoogleFactory()
    {
        $this->app->singleton('google.factory', function (Container $app) {
            $auth = $app['google.authfactory'];
            $path = $app['path.storage'].'/google';

            return new GoogleFactory($auth, $path);
        });

        $this->app->alias('google.factory', GoogleFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('google', function (Container $app) {
            $config = $app['config'];
            $factory = $app['google.factory'];

            return new GoogleManager($config, $factory);
        });

        $this->app->alias('google', GoogleManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('google.connection', function (Container $app) {
            $manager = $app['google'];

            return $manager->connection();
        });

        $this->app->alias('google.connection', \Google_Client::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'google.authfactory',
            'google.factory',
            'google',
            'google.connection',
        ];
    }
}
