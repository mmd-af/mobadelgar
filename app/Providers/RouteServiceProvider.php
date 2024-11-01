<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
//        });
//
//        $this->routes(function () {
//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));
//
//            Route::middleware('web')
//                ->group(base_path('routes/web.php'));
//        });

        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        $this->mapWebAuthRoutes();
        $this->mapWebAdminRoutes();
        $this->mapWebSiteRoutes();
    }

    protected function mapWebAuthRoutes()
    {
        $routeFiles = glob(base_path('routes/web/auth/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware('web')
                ->group($routeFile);
        }
    }
    protected function mapWebAdminRoutes()
    {
        $routeFiles = glob(base_path('routes/web/admin/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware('web')
                ->group($routeFile);
        }
    }

    protected function mapWebSiteRoutes()
    {
        $routeFiles = glob(base_path('routes/web/site/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware('web')
                ->group($routeFile);
        }
    }
}
