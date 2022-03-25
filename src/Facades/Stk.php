<?php

namespace Helaplus\Stk\Facades;

use Illuminate\Support\Facades\Facade;

class Stk extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'stk';
    }
}
