<?php


namespace ClearAir\LaravelRequestUnique\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class RequestIdNotFoundException extends HttpException
{
    public function __construct(int $statusCode = 442, string $message = null, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct($message, $statusCode, $previous);
    }
}