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
        
        return in_array($this->getRole(), $role);
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
        $available = config('access.permissions.roles.'.$this->getRole(), []);
        
        if (count($available) === 1 && $available[0] == '*') {
            return true;
        }
        
        foreach ($permissions as $permission) {
            if (
                in_array($this->permissionAbilityMap($permission), $available) ||
                in_array($permission, $available)
            ) {
                $authorized = true;
            }
        }
        
        return $authorized;
    }
    
    /**
     * @param string $permission
     *
     * @return string
     */
    private function permissionAbilityMap($permission)
    {
        $abilities = config('access.ability_map');
        
        if (empty($abilities)) {
            return $permission;
        }
        
        $permission = explode('.', $permission);
        
        if (count($permission) < 2) {
            return implode('.', $permission);
        }
        
        $last = strtr(array_pull($permission, count($permission)-1), $abilities);
        
        return implode('.', $permission) . '.' . $last;
    }
}
