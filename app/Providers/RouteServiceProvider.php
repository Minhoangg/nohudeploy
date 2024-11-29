<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        // $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapClientRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $adminRoutesPath = base_path('routes/system');

        if (File::isDirectory($adminRoutesPath)) {
            $routeFiles = File::allFiles($adminRoutesPath);

            foreach ($routeFiles as $routeFile) {
                Route::middleware('web')
                     ->prefix('system')
                     ->name('system.')
                     ->group($routeFile->getPathname());
            }
        }
    }

    protected function mapClientRoutes()
    {
        $adminRoutesPath = base_path('routes/client');

        if (File::isDirectory($adminRoutesPath)) {
            $routeFiles = File::allFiles($adminRoutesPath);

            foreach ($routeFiles as $routeFile) {
                Route::middleware('web')
                     ->name('client.')
                     ->group($routeFile->getPathname());
            }
        }
    }
}
