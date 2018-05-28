<?php

namespace Sciarcinski\LaravelAuthorize\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role
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
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if ($this->auth->guest() || !$request->user()->hasRole($roles)) {
            abort(403);
        }
        
        return $next($request);
    }
}
