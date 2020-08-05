<?php


namespace ClearAir\LaravelRequestUnique\Interfaces;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface RequestUniqueInterface
{
    public function generateUniqueId(Request $request = null): string;

    public function validator(Request $request): void;

    public function buildResponse(Response $response): Response;

}