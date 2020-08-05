<?php

namespace ClearAir\LaravelRequestUnique;

use ClearAir\LaravelRequestUnique\Exceptions\RequestIdNotFoundException;
use Illuminate\Http\Request;
use ClearAir\LaravelRequestUnique\Interfaces\RequestUniqueInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class RequestUniqueId implements RequestUniqueInterface
{
    public function generateUniqueId(Request $request = null): string
    {
        return \Illuminate\Support\Str::uuid();
    }

    public function validator(Request $request): void
    {
        if ($request->method() === Request::METHOD_POST) {
            $requestId = $request->get('X-Request-ID');

            if (!$requestId) {
                throw new RequestIdNotFoundException();

            }

            if (!Cache::pull($requestId, null)) {
                throw new RequestIdNotFoundException();
            }
        }
    }

    public function buildResponse(Response $response): Response
    {
        $requestId = $this->generateUniqueId();
        $response->header('Set-Request-ID', $requestId);
        Cache::put($requestId, 1, 300);

        return $response;
    }
}