<?php

if ( ! function_exists('access')) {
    
    /**
     * @return \Sciarcinski\LaravelAuthorize\Access
     */
    function access()
    {
       return app('access');       
    }
}

if ( ! function_exists('permission')) {
    
    /**
     * @param $permission
     * 
     * @return bool
     */
    function permission($permission)
    {
        return access()->hasPermission($permission);
    }
}

if ( ! function_exists('role')) {
    
    /**
     * @param $role
     * 
     * @return bool
     */
    function role($role)
    {
        return access()->hasRole($role);
    }
}

if ( ! function_exists('is_super_admin')) {
    
    /**
     * @return bool
     */
    function is_super_admin()
    {
        return access()->isSuperAdmin();
    }
}