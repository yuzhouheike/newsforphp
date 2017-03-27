<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Http\Request;

class VerifyCsrfToken extends BaseVerifier {

    protected $except = [
        'api/102',
        'api/search',
        'api/detail',
        'api/articles',
        'api/register',
        'api/medias',
        'api/subscribe',
        'api/putsubscribe',
        'api/delsubscribe',
        'api/like',
        'api/unlike',
        'api/feedback',
        'api/medialist',
        'api/log',
        'api/collection',
        'v1/api/102',
        'v1/api/search',
        'v1/api/detail',
        'v1/api/articles',
        'v1/api/register',
        'v1/api/medias',
        'v1/api/subscribe',
        'v1/api/putsubscribe',
        'v1/api/delsubscribe',
        'v1/api/like',
        'v1/api/unlike',
        'v1/api/feedback',
        'v1/api/medialist',
        'v1/api/log',
        'v1/api/collection',
        'v2/api/articles',
        'v2/api/feedback'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        foreach ($this->except as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        return parent::handle($request, $next);
    }

}
