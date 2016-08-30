<?php

namespace Sciarcinski\LaravelAuthorize\Facades;

use Illuminate\Support\Facades\Facade;

class AccessFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}