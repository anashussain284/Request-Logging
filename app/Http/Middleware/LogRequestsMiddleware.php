<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $response = $next($request);
        $endTime = microtime(true);
        $executionTime = number_format(($endTime - $startTime) * 1000, 2);

        Log::warning("----START----");
        Log::info("method = {$request->method()}");
        Log::info("url = {$request->fullUrl()}");
        Log::info("ip = {$request->ip()}");
        Log::info("response_time_ms = {$executionTime}");
        Log::warning("----END----");

        return $response;
    }
}
