<?php

return [
    
    'role' => \App\Role::class,
    
    'ability_map' => [
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete',
    ],
    
    'permissions' => [
        
        'available' => [],
        
        'roles' => [],
    ],
    
];
