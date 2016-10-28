<?php

namespace Sciarcinski\LaravelAuthorize\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authorize
{
    
    /** @var Guard */
    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->auth->user()->hasPermission($request->route()->getName())) {
            abort(403);
        }
        
        return $next($request);
    }
}
