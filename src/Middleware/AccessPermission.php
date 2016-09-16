<?php

namespace Sciarcinski\LaravelAuthorize\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AccessPermission
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
    public function handle($request, Closure $next, $permissions)
    {
        if ($this->auth->guest() || !$request->user()->permission($permissions)) {
            abort(403);
        }
        
        return $next($request);
    }
}
