<?php

namespace Efficio\Test\Mock\Cache;

use Efficio\Cache\FileCache;

class NoTouchCache extends FileCache
{
    protected static $touch = 'Efficio\Test\Mock\Cache\NoTouchCacheReturnFalse';
}

function NoTouchCacheReturnFalse()
{
    return false;
}
