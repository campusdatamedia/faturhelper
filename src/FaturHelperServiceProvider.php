<?php

namespace Ajifatur\FaturHelper;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Router;
use Ajifatur\FaturHelper\Http\Middleware\Admin;
use Ajifatur\FaturHelper\Http\Middleware\NonAdmin;
use Ajifatur\FaturHelper\Http\Middleware\Guest;

class FaturHelperServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any package services.
	 *
	 * @return void
	 */
	public function boot(Router $router)
	{
		// Add package's view
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'faturhelper');

        // Add middlewares
        $router->aliasMiddleware('faturhelper.admin', Admin::class);
        $router->aliasMiddleware('faturhelper.nonadmin', NonAdmin::class);
        $router->aliasMiddleware('faturhelper.guest', Guest::class);
		
		// Use Bootstrap on paginator
		Paginator::useBootstrap();
	}

    /**
     * Register the application services.
     */
    public function register()
    {
        app()->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);
    }
}