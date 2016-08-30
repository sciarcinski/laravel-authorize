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
     * @return boolean
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
     * @return boolean
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
     * @return boolean
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
     * @return boolean
     */
    public function hasUser()
    {
        return !is_null($this->user());
    }
}