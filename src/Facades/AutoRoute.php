<?php

namespace Ofi\Route\Facades;

use Illuminate\Support\Facades\Facade;

class AutoRoute extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return "autoroute";
    }
}
