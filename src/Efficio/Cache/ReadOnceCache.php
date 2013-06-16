<?php

namespace Efficio\Cache;

use Efficio\Cache;

/**
 * remove a cached item after it is requested
 */
class ReadOnceCache extends RuntimeCache
{
    /**
     * @inheritdoc
     */
    public function get($key)
    {
        $val = $this->data[ $key ];
        $this->del($key);
        return $val;
    }
}
