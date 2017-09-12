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

/**
 * Preflight response handler middleware -- responses to preflight browser 
 * OPTIONS request with proper headers
 *
 * @category Middleware
 * @package  App\Http\Middleware
 * @class    PreflightResponse
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
        if ($request->getMethod() === "OPTIONS") {
            return response('');
        }

        return $next($request);
    }
}
