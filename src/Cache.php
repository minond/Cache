<?php

namespace Efficio;

use ArrayAccess;
use Countable;

/**
 * base Cache class
 */
abstract class Cache implements ArrayAccess, Countable
{
    /**
     * value setter. returns success
     * @param string $key
     * @param mixed $val
     * @return boolean
     */
    abstract public function set($key, $val);

    /**
     * value getter
     * @param string $key
     * @return mixed
     */
    abstract public function get($key);

    /**
     * value checker
     * @param string $key
     * @return boolean
     */
    abstract public function has($key);

    /**
     * value unsetter
     * @param string $key
     * @return boolean
     */
    abstract public function del($key);

    /**
     * clear the whole cache
     */
    abstract public function clear();

    /**
     * setter shortcut: $cache->key = $val;
     * @param string $key
     * @param mixed $val
     * @return mixed
     */
    final public function __set($key, $val)
    {
        $this->set($key, $val);
        return $val;
    }

    /**
     * getter shortcut: $val = $cache->key;
     * @param string $key
     * @return mixed
     */
    final public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * isset shortcut: isset($cache->key)
     * @param string $key
     * @return boolean
     */
    final public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * unset shortcut: unset($cache->key)
     * @param string $key
     * @return boolean
     */
    final public function __unset($key)
    {
        return $this->del($key);
    }

    /**
     * setter shortcut: $cache[key] = $val;
     * @param string $key
     * @param mixed $val
     * @return mixed
     */
    final public function offsetSet($key, $val)
    {
        $this->set($key, $val);
        return $val;
    }

    /**
     * getter shortcut: $val = $cache[key];
     * @param string $key
     * @return mixed
     */
    final public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * isset shortcut: isset($cache[key])
     * @param string $key
     * @return boolean
     */
    final public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * unset shortcut: unset($cache[key])
     * @param string $key
     * @return boolean
     */
    final public function offsetUnset($key)
    {
        return $this->del($key);
    }
}
