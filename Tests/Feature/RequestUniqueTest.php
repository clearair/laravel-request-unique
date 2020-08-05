<?php


namespace Tests\Feature;

use ClearAir\LaravelRequestUnique\Http\Middleware\LaravelRequestUniqueMiddleware;
use ClearAir\LaravelRequestUnique\RequestUniqueId;
use \Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Facade;

# TODO test 完善
class RequestUniqueTest extends TestCase
{

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();
        if (! $this->app) {
            $this->refreshApplication();
        }

        $this->setUpTraits();

        foreach ($this->afterApplicationCreatedCallbacks as $callback) {
            call_user_func($callback);
        }

        Facade::clearResolvedInstances();

        $this->setUpHasRun = true;
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {

        $app = new \Illuminate\Foundation\Application(
             dirname(__DIR__)
        );


//        $app->singleton(
//            Illuminate\Contracts\Console\Kernel::class,
//            App\Console\Kernel::class
//        );

//        $app->singleton(
//            Illuminate\Contracts\Debug\ExceptionHandler::class,
//            App\Exceptions\Handler::class
//        );

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function testGenerateUniqueId()
    {
        $re = new RequestUniqueId();
        $this->assertTrue(is_string($re->generateUniqueId()));
    }

    public function testMiddleware()
    {
        $middleware = new LaravelRequestUniqueMiddleware(app(RequestUniqueId::class));
        $this->assertThat(method_exists($middleware, 'handle'),
            $this->isTrue());

        $request = new Request();
        $response = new Response();

        $closure = function (Request $request) use ($response) {
            return $response;
        };

        $response = $middleware->handle($request, $closure);
    }
}