<?php

namespace Efficio\Cache;

use Efficio\Cache;

/**
 * save everything in an array
 */
class RuntimeCache extends Cache
{
    /**
     * internal cache
     */
    protected $data = [];

    /**
     * @inheritdoc
     */
    public function set($key, $val)
    {
        $this->data[ $key ] = $val;
        return true;
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return $this->data[ $key ];
    }

    /**
     * @inheritdoc
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @inheritdoc
     */
    public function del($key)
    {
        unset($this->data[ $key ]);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->data);
    }
}
