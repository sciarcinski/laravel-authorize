<?php

namespace Sciarcinski\LaravelAuthorize\Contracts;

interface Accessable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role();
    
    /**
     * @return string
     */
    public function getRole();
    
    /**
     * @return bool
     */
    public function isSuperAdmin();
    
    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role);
    
    /**
     * @param $role
     *
     * @return bool
     */
    public function hasPermission($permission);
}
