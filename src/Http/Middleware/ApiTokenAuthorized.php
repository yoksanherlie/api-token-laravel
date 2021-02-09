<?php

namespace Silverbullet\ApiTokenLaravel\Http\Middleware;

use Closure;
use Silverbullet\ApiTokenLaravel\Models\ApiToken;

class ApiTokenAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $code
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$codes)
    {
        $authorizationHeader = $request->header('Authorization');
        $token = substr($authorizationHeader, 7);

        $validToken = ApiToken::where('token', '=', $token)->first();

        if ($validToken) {
            $valid = ApiToken::whereIn('code', '=', $codes)->where('token', '=', $token)->first();

            if ($valid) {
                return $next($request);
            }

            abort(403, 'Unauthorized.');
        }

        abort(401, 'Unauthenticated.');
    }
}