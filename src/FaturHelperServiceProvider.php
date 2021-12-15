<?php

namespace Ajifatur\FaturHelper;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\File;
use Ajifatur\FaturHelper\Http\Middleware\Admin;
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
        $router->aliasMiddleware('faturhelper.guest', Guest::class);
        $router->aliasMiddleware('faturhelper.admin', Admin::class);
		
		// Use Bootstrap on paginator
		Paginator::useBootstrap();
	}

    /**
     * Register the application services.
     */
    public function register()
    {
        // Load helpers
        // $this->loadHelpers();
    }

    /**
     * Load helpers.
     * 
	 * @return void
     */
    protected function loadHelpers()
    {
        foreach(glob(__DIR__.'/HelpersExt/*.php') as $filename) {
            require_once $filename;
        }
    }
}