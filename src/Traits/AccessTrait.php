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
    
    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if (!is_array($permission)) {
            $permission = [$permission];
        }
    }
}
