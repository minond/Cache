<?php

namespace Efficio\Test\Mock\Cache;

use Efficio\Cache\FileCache;

class NoFileExistsOrMkdirCache extends FileCache
{
    protected static $file_exists = 'Efficio\Test\Mock\Cache\NoFileExistsOrMkdirCacheReturnFalse';
    protected static $mkdir = 'Efficio\Test\Mock\Cache\NoFileExistsOrMkdirCacheReturnFalse';
}

function NoFileExistsOrMkdirCacheReturnFalse()
{
    return false;
}
