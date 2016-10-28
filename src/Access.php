<?php

namespace Sciarcinski\LaravelAuthorize;

use Illuminate\Foundation\Application;

class Access
{
    /** @var Application */
    protected $app;
    
    /**
     * @param Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    /**
     * @return Illuminate\Auth\UserInterface|null
     */
    public function user()
    {
        return $this->app->auth->user();
    }
    
    /**
     * Is user super admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        if ($this->hasUser()) {
            return $this->user()->isSuperAdmin();
        }
        
        return false;
    }
    
    /**
     * Has user a role
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->hasUser()) {
            return $this->user()->hasRole($role);
        }
        
        return false;
    }
    
    /**
     * Has user a permission
     *
     * @param $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ($this->hasUser()) {
            return $this->user()->hasPermission($permission);
        }
        
        return false;
    }

    /**
     * Has user
     *
     * @return bool
     */
    protected function hasUser()
    {
        return !is_null($this->user());
    }
}
