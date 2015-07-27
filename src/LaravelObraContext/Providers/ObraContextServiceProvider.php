<?php

namespace Ghi\LaravelObraContext\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ObraContextServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        View::composer(config('ghi-context.view-composer', 'partials.nav'), \Ghi\LaravelObraContext\Composers\ObraComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindContext();

        $this->loadViewsFrom(__DIR__ . '/../../views', 'ghi');

        $this->publishes([
            __DIR__ . '/../../views' => base_path('resources/views/vendor/ghi')
        ], 'views');

        $this->publishes([
            __DIR__.'/../../assets/company-icon.png' => public_path('img/company-icon.png'),
            __DIR__.'/../../assets/favicon.ico' => public_path('favicon.ico'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../config/ghi-context.php' => config_path('ghi-context.php'),
        ]);
    }

    /**
     *
     */
    private function bindContext()
    {
        $this->app->bind(
            \Ghi\Core\Contracts\Context::class,
            \Ghi\LaravelObraContext\ContextSession::class
        );

        $this->app->singleton('ghi.context', \Ghi\LaravelObraContext\ContextSession::class);
    }
}
