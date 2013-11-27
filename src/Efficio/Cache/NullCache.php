<?php

namespace Efficio\Cache;

/**
 * doesn't save anything
 */
class NullCache extends RuntimeCache
{
    /**
     * @inheritdoc
     */
    public function set($key, $val)
    {
        return true;
    }
}

