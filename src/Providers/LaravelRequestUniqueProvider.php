<?php


namespace ClearAir\LaravelRequestUnique\Providers;


use ClearAir\LaravelRequestUnique\Interfaces\RequestUniqueInterface;
use ClearAir\LaravelRequestUnique\Http\Middleware\LaravelRequestUniqueMiddleware;
use ClearAir\LaravelRequestUnique\RequestUniqueId;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LaravelRequestUniqueProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerMiddleware($router);
    }

    public function register()
    {
        $this->app->bind(RequestUniqueInterface::class, RequestUniqueId::class);
    }


    /**
     * Register middleware
     *
     * Support added for different Laravel versions
     *
     * @param Router $router
     */
    protected function registerMiddleware(Router $router)
    {
        $router->aliasMiddleware('request.unique', LaravelRequestUniqueMiddleware::class);
    }
}