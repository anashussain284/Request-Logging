<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Models\LogRequestsModel;

class LogRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** Check logging toggle value is enable/disable */
        if (!config('logging.enable_request_logging', false)) {
            return $next($request);
        }

        /** Calculate the execution time */
        $startTime = microtime(true);
        $response = $next($request);
        $endTime = microtime(true);
        $executionTime = number_format(($endTime - $startTime) * 1000, 2);

        /** Save request details into DB */
        LogRequestsModel::create([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'response_time_ms' => $executionTime
        ]);

        return $response;
    }
}
