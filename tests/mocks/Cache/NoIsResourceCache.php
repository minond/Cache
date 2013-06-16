<?php

namespace Efficio\Test\Mock\Cache;

use Efficio\Cache\FileCache;

class NoIsResourceCache extends FileCache
{
    protected static $is_resource = 'Efficio\Test\Mock\Cache\NoIsResourceCacheReturnFalse';
}

function NoIsResourceCacheReturnFalse()
{
    return false;
}
