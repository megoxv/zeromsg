<?php

namespace Megoxv\ZeroMsg\Facades;

use Illuminate\Support\Facades\Facade;

class ZeroMsg extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zeromsg';
    }
}
