<?php
/**
 * Preflight response handler middleware
 * PHP Version 7
 *
 * @category Middleware
 * @package  App\Http\Middleware
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App\Http\Middleware;

use Closure;
use \Log;

/**
 * Preflight response handler middleware -- responses to preflight browser 
 * OPTIONS request with proper headers
 *
 * @category Middleware
 * @package  App\Http\Middleware
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class PreflightResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request to process
     * @param \Closure                 $next    Next object in a middleware 
     *                                          chain
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $http_origin = isset($_SERVER['HTTP_ORIGIN']) ? 
            $_SERVER['HTTP_ORIGIN'] : false;

        $allowed_origins = [
            'https://cgw.cryptany.io', 'https://mobile.cryptany.io',
            'https://www.forsta.com'
        ];

		Log::info('Got preflight request:'.$request);

//        if (in_array($http_origin, $allowed_origins)) {
            return $next($request)->header('Access-Control-Allow-Origin', '*')
                ->header(
                    'Access-Control-Allow-Methods', 
                    'POST, GET, OPTIONS, PUT, DELETE'
                )
                ->header(
                    'Access-Control-Allow-Headers', 
                    'Content-Type, Accept, Authorization, X-Requested-With'
                );
//        }

//        return $next($request);
    }
}
