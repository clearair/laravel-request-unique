<?php


namespace ClearAir\LaravelRequestUnique\Http\Middleware;

use ClearAir\LaravelRequestUnique\Interfaces\RequestUniqueInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaravelRequestUniqueMiddleware
{
    public $requestUniqueInterface;

    public function __construct(RequestUniqueInterface $requestUniqueInterface)
    {
        $this->requestUniqueInterface = $requestUniqueInterface;
    }

    public function handle(Request $request, Closure $next)
    {
        $this->requestUniqueInterface->validator($request);

        /* @var Response $response*/
        $response = $next($request);

        return $this->requestUniqueInterface->buildResponse($response);
    }
}