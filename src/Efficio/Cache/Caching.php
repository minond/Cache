<?php

namespace Efficio\Cache;

use Efficio\Cache;

/**
 * adds setCache and getCache
 */
trait Caching
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @param Cache $cache
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }
}
