<?php

namespace Sciarcinski\LaravelAuthorize\Traits;

trait AccessTrait
{
    /**
     * User has single role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(config('access.role'));
    }
    
    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role->slug;
    }
    
    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role->super_admin;
    }
    
    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if (!is_array($role)) {
            $role = [$role];
        }
        
        return in_array($this->role->slug, $role);
    }
    
    /**
     * @param $permissions
     *
     * @return bool
     */
    public function hasPermission($permissions)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }
        
        $authorized = false;
        $available = config('access.permissions.roles.'.$this->role->slug, []);
        
        if (count($available) === 1 && $available[0] == '*') {
            return true;
        }
        
        foreach ($permissions as $permission) {
            if (in_array($permission, $available)) {
                $authorized = true;
            }
        }
        
        return $authorized;
    }
}
